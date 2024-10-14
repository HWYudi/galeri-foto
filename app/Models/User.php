<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Username',
        'Password',
        'Email',
        'NamaLengkap',
        'Alamat',
        'Level',
        'Image',
    ];

    public $timestamps = false;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'Password',
        // 'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    protected $table = 'user';
    protected $primaryKey = 'UserID';

    public function getAuthPassword()
    {
        return $this->Password; // pastikan password menggunakan kolom Password
    }

    public function post()
    {
        return $this->hasMany(Post::class , 'UserID');
    }

    public function like()
    {
        return $this->hasMany(Like::class , 'UserID');
    }

    public function comment()
    {
        return $this->hasMany(Comment::class , 'UserID');
    }

    // public function reply()
    // {
    //     return $this->hasMany(Reply::class);
    // }

    // public function followers()
    // {
    //     return $this->hasMany(Follow::class, 'following_id');
    // }

    public function album()
    {
        return $this->hasMany(Album::class , 'UserID');
    }

    // public function following()
    // {
    //     return $this->hasMany(Follow::class, 'follower_id');
    // }

    // public function sender()
    // {
    //     return $this->hasMany(Chat::class, 'sender_id');
    // }

    // public function receiver()
    // {
    //     return $this->hasMany(Chat::class, 'receiver_id');
    // }

    // public function senderNotif()
    // {
    //     return $this->hasMany(Notif::class, 'sender_id');
    // }

    // public function receiverNotif()
    // {
    //     return $this->hasMany(Notif::class, 'receiver_id');
    // }

    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }
}
