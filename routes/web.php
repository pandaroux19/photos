<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\PhotoController;
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

Route::group(['middleware' => 'auth'], function(){
    Route::resource('/album', AlbumController::class, ['names'=>["index"=>"albumIndex", "show"=>"albumShow", "create"=>"albumCreate", "store"=>"albumStore", "destroy"=>"albumDestroy"]])->only(["create", "store", "destroy"]);
});

Route::group(['middleware' => 'auth'], function() {
    Route::resource('/photo', PhotoController::class, ['names'=>["store"=>"photoStore", "destroy"=>"photoDestroy"]])->only(["store", "destroy"]);
});

Route::resource('/album', AlbumController::class, ['names'=>["index"=>"albumIndex", "show"=>"albumShow", "create"=>"albumCreate", "store"=>"albumStore", "destroy"=>"albumDestroy"]])->only(["index", "show"]);

Route::resource('/tag', TagController::class, ['names'=>["index"=>"tagIndex", "show"=>"tagShow"]])->only(["index", "show"]);

// Route::get('/album', [AlbumController::class, 'showAlbums'])->name('albums');

// Route::get('/album/{id}', [AlbumController::class, 'showAlbum'])->name('album')->where('id', '(?!nouveau$).*$');

// Route::get('/album/nouveau', [AlbumController::class, 'newAlbum'])->name('newAlbum');
// Route::post('/album/nouveau', [AlbumController::class, 'storeAlbum']);

// Route::get('/tag', [AlbumController2::class, 'showTags'])->name('tags');

// Route::get('/tag/{id}', [AlbumController2::class, 'showTag'])->name('tag');