<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Reply;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
{
    $request->validate([
        'body' => 'required',
    ]);

    // Menambahkan komentar ke dalam tabel komentarfoto
    Comment::create([
        'FotoID' => $request->post_id, // Mengambil FotoID dari request
        'UserID' => auth()->user()->UserID, // Menggunakan UserID dari pengguna yang sedang login
        'IsiKomentar' => $request->body, // Mengambil isi komentar dari request
        'TanggalKomentar' => now(), // Menyimpan tanggal komentar saat ini
    ]);

    return back()->with('message', 'Komentar Berhasil Ditambahkan');
}


    // public function reply(Request $request){
    //     $request->validate([
    //         'body' => 'required',
    //     ]);

    //     Reply::create([
    //         'comment_id' => $request->comment_id,
    //         'user_id' => auth()->user()->id,
    //         'body' => $request->body
    //     ]);

    //     return back();
    // }
}
