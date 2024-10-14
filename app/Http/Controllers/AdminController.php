<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function dashboard()
    {
        $users = User::paginate(10);
        return view('admin.dashboard', compact('users'));
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $users = User::where('Username', 'like', '%' . $search . '%')->paginate(10);
        return view('admin.dashboard', compact('users'));
    }

    public function index()
    {
        $posts = Post::with(['user'])->paginate(10);
        return view('admin.datafoto', compact('posts'));
    }

    public function destroy(Request $request, $id)
    {
        // Cari post berdasarkan id
        $post = Post::find($id);

        // Cek apakah post ini terkait dengan album
        if ($post->album_id !== null) {
            // Ambil album yang terkait dengan post ini
            $album = Album::find($post->album_id);

            // Hapus post
            $post->delete();

            // Cek apakah album ini masih memiliki post lain
            if ($album->post()->count() == 0) {
                // Jika tidak ada post lain di album, hapus album
                $album->delete();
            }
        } else {
            // Jika post tidak terkait dengan album, hapus langsung
            $post->delete();
        }

        // Redirect kembali dengan pesan sukses
        return back()->with('success', 'Post dan album terkait (jika tidak ada post lain) berhasil dihapus.');
    }


    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('admin.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'JudulFoto' => 'required|string|max:255',
            'DeskripsiFoto' => 'required|string|max:255',
            'LokasiFile' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrFail($id);
        $post->JudulFoto = $request->JudulFoto;
        $post->DeskripsiFoto = $request->DeskripsiFoto;

        if ($request->hasFile('LokasiFile')) {
            // Delete the old image
            Storage::disk('public')->delete($post->LokasiFile);

            // Store the new image
            $imagePath = $request->file('LokasiFile')->store('posts', 'public');
            $post->LokasiFile = $imagePath;
        }

        $post->save();

        return redirect('/admin/foto')->with('success', 'Post updated successfully');
    }


    public function searchpost(Request $request)
    {
        $search = $request->input('search');
        $posts = Post::where('title', 'like', '%' . $search . '%')->orwhere('id', $search)->orwherehas('user', function ($query) use ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        })->paginate(5);
        return view('admin.datafoto', compact('posts'));
    }


    public function manageAlbums(Request $request)
    {
        $search = $request->input('search');
        $query = Album::with('user'); // Tambahkan 'with' untuk memuat relasi dengan user

        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('NamaAlbum', 'like', '%' . $search . '%')
                  ->orWhere('Deskripsi', 'like', '%' . $search . '%');
            });
        }

        $albums = $query->latest('TanggalDibuat')->paginate(10);

        if ($request->ajax()) {
            return view('admin.album-list', compact('albums'))->render();
        }

        return view('admin.manage-albums', compact('albums', 'search'));
    }

    public function storeAlbum(Request $request)
    {
        $request->validate([
            'NamaAlbum' => 'required',
            'Deskripsi' => 'nullable',
        ]);

        Album::create([
            'NamaAlbum' => $request->NamaAlbum,
            'Deskripsi' => $request->Deskripsi,
            'TanggalDibuat' => now(),
            'UserID' => auth()->id(),
        ]);

        return redirect()->route('admin.manage.albums')->with('success', 'Album berhasil ditambahkan');
    }

    public function editAlbum($id)
    {
        $album = Album::findOrFail($id);
        return view('admin.edit-album', compact('album'));
    }

    public function updateAlbum(Request $request, $id)
    {
        $request->validate([
            'NamaAlbum' => 'required',
            'Deskripsi' => 'nullable',
        ]);

        $album = Album::findOrFail($id);
        $album->update([
            'NamaAlbum' => $request->NamaAlbum,
            'Deskripsi' => $request->Deskripsi,
        ]);

        return redirect()->route('admin.manage.albums')->with('success', 'Album berhasil diperbarui');
    }

    public function destroyAlbum($id)
    {
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->route('admin.manage.albums')->with('success', 'Album berhasil dihapus');
    }
}
