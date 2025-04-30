<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Web\BlogController;
use App\Http\Controllers\Web\LandingController;
use App\Http\Controllers\Web\ProjectController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', [LandingController::class, 'landing']);

// blogs
Route::get('/blogs', [BlogController::class, 'index'])->name('front.blogs.index');
Route::get('/blogs/all', [BlogController::class, 'all'])->name('front.blogs.all');
Route::get('/blogs/search', [BlogController::class, 'search'])->name('front.blogs.search');
Route::get('/blogs/category/{blogCategory:slug}', [BlogController::class, 'category'])->name('front.blogs.category');
Route::get('/blogs/{blog:slug}', [BlogController::class, 'show'])->name('front.blogs.show');

// projects
Route::get('/projects', [ProjectController::class, 'index'])->name('front.projects.index');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
