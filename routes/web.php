<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarListingController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Listings
|--------------------------------------------------------------------------
| IMPORTANT: /listings/create must be registered BEFORE /listings/{listing}
*/

// AUTH routes first (so /listings/create is not stolen by {listing})
Route::middleware('auth')->group(function () {
    Route::get('/listings/create', [CarListingController::class, 'create'])->name('listings.create');
    Route::post('/listings', [CarListingController::class, 'store'])->name('listings.store');
    Route::get('/listings', [CarListingController::class, 'index'])->name('listings.index');
    Route::get('/listings/{listing}', [CarListingController::class, 'show'])
    ->whereNumber('listing')
    ->name('listings.show');

    // (optional later)
    // Route::get('/listings/{listing}/edit', [CarListingController::class, 'edit'])->name('listings.edit');
    // Route::put('/listings/{listing}', [CarListingController::class, 'update'])->name('listings.update');
    // Route::delete('/listings/{listing}', [CarListingController::class, 'destroy'])->name('listings.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
