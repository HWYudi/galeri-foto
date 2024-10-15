<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $table = 'komentarfoto';
    protected $primaryKey = 'KomentarID';
    public $timestamps = false;

    protected $fillable = [
        'KomentarID',
        'FotoID',
        'UserID',
        'IsiKomentar',
        'TanggalKomentar',
    ];

    public function post(){
        return $this->belongsTo(Post::class , 'FotoID' , 'FotoID');
    }

    public function user(){
        return $this->belongsTo(User::class , 'UserID' , 'UserID');
    }
}
