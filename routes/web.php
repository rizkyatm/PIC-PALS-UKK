<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\KomentarController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\searchController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login-admin', function () {  return view('admin.loginTemplate');})->name('TampilanLogin');

Route::get('/Dashboard', function () {  return view('admin.dashboard');});

Route::get('/pic-pals', [FotoController::class, 'index'])->name('index.photo');

Route::post('/store-photo', [FotoController::class, 'storeFoto'])->name('store.photo');
Route::post('/update/photo/{id}', [FotoController::class, 'updateFoto'])->name('update.photo');
Route::delete('/delete-foto/{id}', [FotoController::class, 'deleteFoto'])->name('delete.photo');
Route::post('/store/comment', [KomentarController::class, 'store'])->name('comments.photo');
Route::get('/get/comment/{id}', [KomentarController::class, 'getComment'])->name('get.comments.photo');
Route::post('/toggle-like', [LikeController::class, 'toggleLike'])->name('toggle-like');
Route::get('/get-like-status', [LikeController::class, 'getLikeStatus'])->name('get-like-status');

Route::get('/search-foto', [searchController::class, 'search'])->name('search');

Route::get('/profile/{id}', [FotoController::class, 'profile'])->name('profile.photo');

Route::get('/albums/{id}', [AlbumController::class, 'getAlbum'])->name('index.album');
Route::post('/store-album', [AlbumController::class, 'create'])->name('store.album');
Route::get('/foto-album/{id}', [AlbumController::class, 'getFoto'])->name('foto.album');


Route::post('/authUser', [loginController::class, 'login'])->name('authUser');
Route::post('/registerUser', [loginController::class, 'register'])->name('registerUser');
Route::get('/logout', [loginController::class, 'logout'])->name('logout');
Route::post('/update-user/{id}', [loginController::class, 'update'])->name('updateUser');
