<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MypageController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () { 
    Route::get('article/sort',[ArticleController::class,'sort']) -> name('article.sort'); 
    Route::resource('article',ArticleController::class);
    

    Route::resource('mypage',MypageController::class);
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
