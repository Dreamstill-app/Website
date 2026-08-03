<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Models\Sort;
use App\Services\Media\ImageStorage;
use Illuminate\Support\Facades\Route;

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

// Sorty landing page. Mobile visitors go straight into the web app —
// the app itself IS the mobile experience.
Route::get('/sorty', function () {
    $ua = request()->userAgent() ?? '';
    if (preg_match('/android|iphone|ipad|ipod|mobile/i', $ua)) {
        return redirect('/demo');
    }

    return view('sorty.landing', [
        'pageTitle' => 'Sorty — AI clothing sorting by DreamStill',
        'metaDescription' => 'Photograph a garment and Sorty\'s AI tells you whether to resell, donate, repair, or recycle it — with real drop-off spots near you. Free, in your browser.',
        'navigationPages' => \App\Models\Page::published()
            ->where('show_in_nav', true)
            ->orderBy('id')
            ->get(),
        'siteSettings' => array_merge(
            \App\Support\Cms\SiteDefaults::settings(),
            \App\Models\SiteSetting::first()?->toArray() ?? []
        ),
    ]);
})->name('pages.sorty');

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

    $storage = app(ImageStorage::class);

    $publicUrl = $storage->publicUrl($image->path);
    if ($publicUrl !== null) {
        return redirect()->away($publicUrl);
    }

    return $storage->response($image->path, [
        'Cache-Control' => 'private, max-age=3600',
    ]);
})->middleware('auth')->name('admin.sort-image');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
