<?php

use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\PostController;
use App\Mail\BroadcastMailable;


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/', [PostController::class, 'index'])->name('posts.index');
    Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::post('/posts/{post}/storeComment', [PostController::class, 'storeComment'])->name('posts.storeComment');
    Route::get('category/{category}', [PostController::class, 'category'])->name('posts.category');
    Route::get('tag/{tag}', [PostController::class, 'tag'])->name('posts.tag'); 
    Route::get('imagenes', [PostController::class, 'imagenes'])->name('posts.imagenes'); 
    
    Route::get('send-mail', [MailController::class, 'index'])->name('index'); 
       

});
