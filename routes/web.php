<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;


// Redirect the root route to /posts
Route::get('/', function () {
    return redirect()->route('posts.index');
});

// Resource route for posts (handles all CRUD automatically)
Route::resource('posts', PostController::class);

//Custom delete route 
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

