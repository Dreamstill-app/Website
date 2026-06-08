<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/app', [PageController::class, 'app'])->name('pages.app');
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('pages.portfolio');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::get('/investors', [PageController::class, 'investors'])->name('pages.investors');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
