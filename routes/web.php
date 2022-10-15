<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\HomeController;
use \App\Http\Controllers\PageController;
use \App\Http\Controllers\PostController;
use \App\Http\Controllers\CommentController;
use \App\Http\Controllers\GalleryController;

Route::get('/', [PageController::class,'index'])->name('index');
Route::get('/detail/{slug}',[PageController::class,'show'])->name('show');
Route::get('/job-test',[PageController::class,'jobTest']);

Auth::routes(['verify'=>true]);

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('post', PostController::class)->except('show','index');
Route::resource('comment',CommentController::class)->only('destroy','store');
Route::resource('gallery',GalleryController::class);

Route::prefix("/user")->group(function (){
    Route::get('edit-profile',[HomeController::class,'editProfile'])->name('editProfile');
    Route::post('update-profile',[HomeController::class,'updateProfile'])->name('updateProfile');
    Route::get('edit-password',[HomeController::class,'editPassword'])->name('editPassword');
    Route::post('update-password',[HomeController::class,'updatePassword'])->name('updatePassword');
});



