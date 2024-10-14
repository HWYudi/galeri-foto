<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'foto';
    protected $primaryKey = 'FotoID';
    public $timestamps = false;

    protected $fillable = [
        'JudulFoto',
        'DeskripsiFoto',
        'TanggalUnggah',
        'LokasiFile',
        'AlbumID',
        'UserID'
    ];

    public function user(){
        return $this->belongsTo(User::class , 'UserID');
    }

    public function like()
{
    return $this->hasMany(Like::class, 'FotoID', 'FotoID');
}

    public function comment(){
        return $this->hasMany(Comment::class , 'FotoID' , 'FotoID');
    }

    public function album()
{
    return $this->belongsTo(Album::class , 'AlbumID' , 'AlbumID');
}
}
