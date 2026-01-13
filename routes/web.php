<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarListingController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('listings', CarListingController::class)
    ->only(['index', 'show']);

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('listings', CarListingController::class)
        ->except(['index', 'show']);
});

require __DIR__.'/auth.php';
