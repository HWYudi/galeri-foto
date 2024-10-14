<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function likes()
{
    $posts = Post::with(['like', 'user', 'comment'])
        ->whereHas('like', function ($query) {
            // Adjust the column name here
            $query->where('UserID', auth()->id()); // Use 'UserID' instead of 'user_id'
        })
        ->orderby('TanggalUnggah')
        ->get();

    $user = auth()->user();
    return Inertia::render('homePage', ['posts' => $posts, 'user' => $user]);
}


    public function index()
    {
        $posts = Post::with(['like', 'user', 'comment'])->latest()->get();
        return view('homepage', compact('posts'));
    }

    public function homepage()
    {
        $posts = Post::with(['like', 'user', 'comment'])
            ->orderBy('TanggalUnggah')
            ->get();

        $user = User::where('UserID', auth()->user())->first();

        return Inertia::render('homePage', [
            'posts' => $posts,
            'user' => $user
        ]);
    }

    public function detailpost($name, $id)
    {
        $post = Post::with(['like', 'user', 'comment.user', 'album'])
            ->where('FotoID', $id)
            ->whereHas('user', function ($query) use ($name) {
                $query->where('Username', $name);
            })
            ->firstOrFail();
        $user = auth()->user();
        // $userAlbums = $user ? $user->albums : collect();

        return Inertia::render('detailPost', [
            'post' => $post,
            'user' => $user,
            // 'userAlbums' => $userAlbums
        ]);
    }

    public function addToAlbum(Request $request, Post $post)
    {
        $request->validate([
            'album_id' => 'required|exists:album,AlbumID', // Changed to 'album,AlbumID'
        ]);

        $post->AlbumID = $request->album_id;
        $post->save();

        return redirect()->back()->with('success', 'Post berhasil ditambahkan ke album');
    }





    public function store(Request $request)
    {
        $request->validate([
            'JudulFoto' => 'required',
            'LokasiFile' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'DeskripsiFoto' => 'required',
        ], [
            'JudulFoto.required' => 'Judul Foto harus diisi.',
            'LokasiFile.required' => 'Gambar harus diunggah.',
        ]);

        // Menyimpan gambar dan mendapatkan path-nya
        $imagePath = $request->file('LokasiFile')->store('posts');

        // Menyimpan data ke database
        Post::create([
            'UserID' => auth()->user()->UserID,
            'JudulFoto' => $request->JudulFoto,
            'DeskripsiFoto' => $request->DeskripsiFoto,
            'TanggalUnggah' => now(),
            'LokasiFile' => $imagePath,
            'AlbumID' => $request->AlbumID, // Pastikan ada input untuk AlbumID jika diperlukan
        ]);

        return redirect()->route('posts.store')->with('message', 'Foto berhasil ditambahkan');
    }


    public function like($id)
    {
        // Cari postingan berdasarkan FotoID
        $post = Post::where('FotoID', $id)->first();

        if (!$post) {
            return back()->with('error', 'Postingan tidak ditemukan');
        }

        // Buat entri like baru dengan mengisi kolom yang diperlukan
        // dd(auth()->user()->UserID);
        Like::create([
            'FotoID' => $id,
            'UserID' => auth()->user()->UserID,
            'TanggalLike' => now(), // Menyimpan waktu saat ini sebagai TanggalLike
        ]);

        return back()->with('success', 'Postingan Berhasil Di Like');
    }



    public function unlike($id)
    {
        $post = Post::where('FotoID', $id)->first();
        $post->like()->where('UserID', auth()->user()->UserID)->delete();
        // return response()->json(['likes_count' => $post->like->count()]);
        return back()->with('success', 'Postingan Berhasil Di UnLike');
    }


    public function destroy($name, $id)
    {
        $post = Post::findOrFail($id);
        if ($post->user->id != auth()->user()->id) {
            return abort(403);
        }

        if ($post->body) {
            Storage::delete($post->body);
        }
        $post->delete();

        return to_route('profile', $name)->with('success', 'Postingan Berhasil Di Hapus');
    }


    public function update(Request $request, $name, $id)
    {
        $request->validate([
            'title' => 'required|max:255', // Validasi untuk input judul
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk foto
            'deskripsi' => 'required', // Validasi untuk deskripsi
        ]);

        // Mengambil post berdasarkan FotoID
        $post = Post::where('FotoID', $id)->firstOrFail(); // Menggunakan firstOrFail untuk mendapatkan satu instans model

        // Cek apakah user yang sedang login adalah pemilik foto
        if ($post->UserID != auth()->user()->UserID) {
            return abort(403);
        }

        // Mengupdate kolom JudulFoto dan DeskripsiFoto
        $post->JudulFoto = $request->title; // Memasukkan nilai title ke JudulFoto
        $post->DeskripsiFoto = $request->deskripsi; // Memasukkan nilai deskripsi ke DeskripsiFoto

        if ($request->hasFile('photo')) { // Mengecek jika ada file foto yang diupload
            // Menghapus foto lama jika ada
            if ($post->LokasiFile) {
                Storage::disk('public')->delete($post->LokasiFile);
            }

            // Menyimpan foto baru
            $path = $request->file('photo')->store('posts', 'public'); // Menyimpan foto baru
            $post->LokasiFile = $path; // Memasukkan path foto ke LokasiFile
        }

        // Mengupdate tanggal unggah ke waktu saat ini
        $post->TanggalUnggah = now(); // Set TanggalUnggah ke saat ini

        $post->save(); // Menyimpan perubahan ke database

        return redirect('/')->with('success', 'Postingan berhasil diperbarui'); // Mengalihkan dengan pesan sukses
    }



    public function search(Request $request)
    {
        $search = $request->input('q');
        $posts = Post::with(['like', 'user', 'comment'])
            ->where('JudulFoto', 'like', '%' . $search . '%')->orWhere('DeskripsiFoto', 'like', '%' . $search . '%')
            ->orWhereHas('user', function ($query) use ($search) {
                $query->where('Username', 'like', '%' . $search . '%');
            })
            ->get();

        return Inertia::render('homePage', ['posts' => $posts]);
    }
}
