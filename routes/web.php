<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostAdminController;

Route::redirect('/', '/posts');

/**
 * Public (misafirler dahil)
 */
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])
    ->middleware('draft.access')
    ->name('posts.show');

/**
 * Auth + Verified (yazar içerik oluşturur, ilk kaydı taslak)
 */
Route::middleware(['auth','verified'])->group(function () {
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
});

/**
 * Admin (superadmin: is_admin = true)
 */
Route::middleware(['auth','verified','is.admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/posts', [PostAdminController::class, 'index'])->name('posts.index');             // taslak + yayınlar
    Route::patch('/posts/{post}/publish', [PostAdminController::class, 'publish'])->name('posts.publish');
    Route::patch('/posts/{post}/draft',   [PostAdminController::class, 'draft'])->name('posts.draft');
});

require __DIR__.'/auth.php'; // Breeze rotaları (login/register/verify)

