<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class AlbumController extends Controller
{
    //
    public function getUserAlbums(User $user)
    {
        return $user->album;
    }

    public function store(Request $request)
    {
        Log::info('Received request:', $request->all());
        $request->validate([
            'nama_album' => 'required',
            'post_id' => 'required',
            'deskripsi' => 'nullable|string|max:255', // Add validation for description
        ]);

        $album = Album::create([
            'NamaAlbum' => $request->nama_album,
            'Deskripsi' => $request->deskripsi, // Save the description
            'TanggalDibuat' => now(),
            'UserID' => auth()->id(),
        ]);

        $post = Post::find($request->post_id);
        $post->AlbumID = $album->AlbumID;
        $post->save();

        return redirect()->back()->with('success', 'Album berhasil dibuat dan post ditambahkan');
    }


public function index()
{
    // Assuming 'UserID' is the correct column name for the user reference
    $albums = Album::where('UserID', auth()->user()->UserID)->with('post')->get();
    return Inertia::render('album', [
        'albums' => $albums
    ]);
}


public function detail($id) {
    // Fetch the album using AlbumID
    $album = Album::where('AlbumID', $id)->with('post')->first(); // Change 'id' to 'AlbumID'

    // Check if the album exists
    if (!$album) {
        return redirect()->back()->with('error', 'Album not found.');
    }

    // Fetch the posts related to the album
    $posts = Post::where('AlbumID', $album->AlbumID) // Change 'album_id' to 'AlbumID'
        ->with(['like', 'user', 'comment.user', 'album'])
        ->get();

    return Inertia::render('homePage', [
        'posts' => $posts,
        'album' => $album, // Optionally pass the album details
    ]);
}


}
