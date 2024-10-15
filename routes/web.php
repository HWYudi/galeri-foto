<?php

use Inertia\Inertia;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotifController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//for authentication
Route::get('/register', function () {
    return view('auth.register');
});
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', function () {
    return view('auth.login');
});
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


//for posts
Route::get('/' , [PostController::class , 'homepage'])->name('home');
Route::post('/', [PostController::class, 'store'])->name('posts.store')->middleware('checkauth');
Route::get('/{name}/post/{id}' , [PostController::class , 'detailpost'])->name('detailpost');
Route::post('/{name}/post/{id}', [PostController::class, 'update'])->middleware('checkauth');
Route::delete('/{name}/post/{id}', [PostController::class, 'destroy'])->middleware('checkauth');


Route::post('/posts/{id}/like', [PostController::class, 'like'])->name('posts.like')->middleware('checkauth');
Route::delete('/posts/{id}/unlike', [PostController::class, 'unlike'])->name('posts.delete')->middleware('checkauth');
Route::post('/comment', [CommentController::class, 'store'])->name('comments.store')->middleware('checkauth');
Route::post('/reply', [CommentController::class, 'reply'])->middleware('checkauth') ;

//for profile
Route::get('/profile/{name}', [AuthController::class, 'profile'])->name('profile')->middleware('checkauth');
Route::get('/account/edit', [AuthController::class, 'edit'])->name('profile.edit')->middleware('checkauth');
Route::post('/account/edit/{id}', [AuthController::class, 'update']);
Route::get('/search', [PostController::class, 'search'])->name('posts.search');

//for admin
Route::get('/dashboard/search' , [AdminController::class , 'search'])->middleware('admin');

Route::get('/data' , function(){
    return view('data');
});
Route::get('/mylikes' , [PostController::class , 'likes'])->name('likes')->middleware('checkauth');

//album
Route::get('/api/users/{user}/albums', [AlbumController::class, 'getUserAlbums']);
Route::post('/albums', [AlbumController::class, 'store']);
Route::post('/posts/{post}/add-to-album', [PostController::class, 'addToAlbum']);
Route::get('/album' , [AlbumController::class , 'index'])->name('album')->middleware('checkauth');
Route::get('/album/{id}' , [AlbumController::class , 'detail'])->name('album.detail')->middleware('checkauth');

Route::get('/admin' , [AdminController::class , 'dashboard'])->name('dashboard')->middleware('admin');
Route::get('/admin/foto' , [AdminController::class , 'index'])->name('data.foto');
Route::get('/admin/foto/search' , [AdminController::class , 'searchpost'])->name('data.foto.search');
Route::delete('/admin/foto/{id}' , [AdminController::class , 'destroy']);
Route::get('/admin/foto/{id}/edit', [AdminController::class, 'edit'])->name('data.foto.edit');
Route::put('/admin/foto/{id}', [AdminController::class, 'update'])->name('data.foto.update');

Route::prefix('admin')->middleware('admin')->group(function () {
    // Route::get('/manage-albums', [AdminController::class, 'manageAlbums'])->name('admin.manage.albums');
    Route::get('/album', [AdminController::class, 'manageAlbums'])->name('admin.manage.albums');
    Route::post('/manage-albums', [AdminController::class, 'storeAlbum'])->name('admin.store.album');
    Route::get('/manage-albums/{id}/edit', [AdminController::class, 'editAlbum'])->name('admin.edit.album');
    Route::put('/manage-albums/{id}', [AdminController::class, 'updateAlbum'])->name('admin.update.album');
    Route::delete('/manage-albums/{id}', [AdminController::class, 'destroyAlbum'])->name('admin.destroy.album');
});
