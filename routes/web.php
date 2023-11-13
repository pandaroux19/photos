<?php

use App\Http\Controllers\AlbumController;
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

Route::get('/album', [AlbumController::class, 'showAlbums'])->name('albums');

Route::get('/album/{id}', [AlbumController::class, 'showAlbum'])->name('album');

Route::get('/tag', [AlbumController::class, 'showTags'])->name('tags');

Route::get('/tag/{id}', [AlbumController::class, 'showTag'])->name('tag');