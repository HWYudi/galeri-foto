<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $table = 'likefoto';
    protected $primaryKey = 'likeID';

    public $timestamps = false;

    protected $fillable = [
        'LikeID',
        'FotoID',
        'UserID',
        'TanggalLike'
    ];

    // App\Models\Like.php
public function post()
{
    return $this->belongsTo(Post::class, 'FotoID', 'FotoID');
}

public function user()
{
    return $this->belongsTo(User::class, 'UserID', 'UserID');
}

}
