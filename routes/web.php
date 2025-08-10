<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostAdminController;

Route::redirect('/', '/posts');

// PUBLIC
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])
    ->middleware('draft.access')
    ->name('posts.show');

// YAZAR (giriş + e‑posta doğrulaması)
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

// ADMIN (superadmin)
Route::middleware(['auth','verified','is.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/posts', [PostAdminController::class, 'index'])->name('posts.index');
    Route::patch('/posts/{post}/publish', [PostAdminController::class, 'publish'])->name('posts.publish');
    Route::patch('/posts/{post}/draft',   [PostAdminController::class, 'draft'])->name('posts.draft');
});
Route::get('/home', function () {
    $u = auth()->user();
    if ($u?->is_admin) {
        return redirect()->route('admin.posts.index');   // admin panel
    }
    return redirect()->route('posts.create');            // yazar formu
})->middleware(['auth','verified'])->name('home');

require __DIR__.'/auth.php'; // Breeze: /login, /register, /email/verify ...

