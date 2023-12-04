<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\FavoriteController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [BukuController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // rate buku
    Route::post('/buku/rate/{id}', [BukuController::class, 'rate'])->name('buku.rate');
    // favorites
    Route::post('/buku/favorite/{id}', [BukuController::class, 'addToFavorites'])->name('buku.favorite');
    Route::get('/buku/myfavorite', [FavoriteController::class, 'index'])->name('favorite.index');
    


    Route::middleware('admin')->group(function () {
        Route::get('/buku/create', [BukuController::class, 'create'])->name('buku.create');
        Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
        Route::get('/buku/edit/{id}', [BukuController::class, 'edit'])->name('buku.edit');
        Route::post('/buku/update/{id}', [BukuController::class, 'update'])->name('buku.update');
        Route::delete('/buku/delete/{id}', [BukuController::class, 'destroy'])->name('buku.destroy');
        Route::get('/gallery/delete/{id}', [BukuController::class, 'deleteGallery'])->name('buku.deleteGallery');
    });
    Route::get('/buku', [BukuController::class, 'index']);
    Route::get('/buku/search', [BukuController::class, 'search'])->name('buku.search');
    Route::get('/buku/myfavourite/', [BukuController::class, 'favbuku'])->name('buku.favourite');
    Route::post('/buku/{id}/rate', [BukuController::class, 'rate'])->name('buku.rate');


});

Route::get('/detail-buku/{title}', [BukuController::class, 'galbuku'])->name('buku.detail');




require __DIR__.'/auth.php';

