<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\TagController;
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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::resource('/album', AlbumController::class, ['names'=>["index"=>"albumIndex", "show"=>"albumShow", "create"=>"albumCreate", "store"=>"albumStore", "edit"=>"albumEdit", "update"=>"albumUpdate"]])->only(["index", "show", "create", "store", "edit", "update"]);

Route::resource('/tag', TagController::class, ['names'=>["index"=>"tagIndex", "show"=>"tagShow"]])->only(["index", "show"]);

// Route::get('/album', [AlbumController::class, 'showAlbums'])->name('albums');

// Route::get('/album/{id}', [AlbumController::class, 'showAlbum'])->name('album')->where('id', '(?!nouveau$).*$');

// Route::get('/album/nouveau', [AlbumController::class, 'newAlbum'])->name('newAlbum');
// Route::post('/album/nouveau', [AlbumController::class, 'storeAlbum']);

// Route::get('/tag', [AlbumController2::class, 'showTags'])->name('tags');

// Route::get('/tag/{id}', [AlbumController2::class, 'showTag'])->name('tag');