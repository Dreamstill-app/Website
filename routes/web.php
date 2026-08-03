<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Models\Sort;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('pages.about');
Route::get('/app', [PageController::class, 'app'])->name('pages.app');
Route::get('/portfolio', [PageController::class, 'portfolio'])->name('pages.portfolio');
Route::get('/contact', [PageController::class, 'contact'])->name('pages.contact');
Route::get('/investors', [PageController::class, 'investors'])->name('pages.investors');

// Legal pages (linked from the Sorty app's sign-up flow).
Route::get('/terms', fn () => view('legal.show', [
    'title' => 'Terms & Conditions',
    'content' => file_get_contents(resource_path('views/legal/_terms_content.html')),
]))->name('legal.terms');

Route::get('/privacy', fn () => view('legal.show', [
    'title' => 'Privacy Policy',
    'content' => file_get_contents(resource_path('views/legal/_privacy_content.html')),
]))->name('legal.privacy');

// Sorty web demo (phone-frame build) lives at /demo — see docs/DEPLOY.md.
Route::get('/demo', function () {
    $index = public_path('app-demo/index.html');
    abort_unless(file_exists($index), 404);

    return response()->file($index);
})->name('sorty.demo');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Admin-only image serving for the Filament Sorts browser (session auth).
Route::get('/admin/sort-image/{sort}/{type}', function (Sort $sort, string $type) {
    abort_unless(auth()->user()?->isAdmin(), 403);
    abort_unless(in_array($type, ['front', 'back', 'tag'], true), 404);

    $image = $sort->images()->where('type', $type)->first();
    abort_if($image === null, 404);

    return Storage::disk('local')->response($image->path, null, [
        'Cache-Control' => 'private, max-age=3600',
    ]);
})->middleware('auth')->name('admin.sort-image');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
