<?php

use App\Http\Controllers\HomeController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
Route::group(['middleware' => 'auth'], function(){
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/posts', [PostController::class, 'index'])->name('list.post');
    Route::get('/post/create', [PostController::class, 'create'])->name('create.post');
    Route::post('/post/store', [PostController::class, 'store'])->name('store.post');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('edit.post');
    Route::post('/post/{id}/update', [PostController::class, 'update'])->name('update.post');
    Route::delete('/post/{id}/delete', [PostController::class, 'destroy'])->name('delete.post');
});


