<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'album';
    protected $primaryKey = 'AlbumID';

    public $timestamps = false;

    protected $fillable = [
        'NamaAlbum',
        'Deskripsi',
        'TanggalDibuat',
        'UserID',
    ];

    public function post(){
        return $this->hasMany(Post::class , 'AlbumID' , 'AlbumID');
    }

    public function user(){
        return $this->belongsTo(User::class , 'UserID');
    }
}
