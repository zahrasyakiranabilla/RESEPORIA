<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\WelcomingController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;


// Routes untuk GUEST (tanpa login)
Route::get('/', [RecipeController::class, 'index'])->name('home');
Route::get('/category/{category}', [RecipeController::class, 'category'])->name('recipes.category');
Route::get('/recipe/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');
Route::get('/api/search', [RecipeController::class, 'searchApi'])->name('recipes.search.api');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);

// Saran routes (guest bisa kirim saran)
Route::get('/saran', [SaranController::class, 'create'])->name('saran.create');
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');

// Rute Registrasi
Route::get('/register', [RegisterController::class, 'show'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

// Routes untuk USER (harus login)
Route::middleware(['auth'])->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Recipe interactions (like, favorite, comment)
    Route::post('/recipe/{recipe}/like', [RecipeController::class, 'like'])->name('recipes.like');
    Route::post('/recipe/{recipe}/favorite', [RecipeController::class, 'toggleFavorite'])->name('recipes.favorite');
    Route::post('/recipe/{recipe}/comment', [CommentController::class, 'store'])->name('comments.store');

    // Favorites page
    Route::get('/favorites', [RecipeController::class, 'favorites'])->name('recipes.favorites');

    // Upload Recipe
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');

    // Welcoming page
    Route::get('/welcoming', [WelcomingController::class, 'index'])->name('welcoming');

    // Logout
    Route::get('/keluar', function () {
        Auth::logout();
        return redirect('/')->with('success', 'Berhasil logout!');
    })->name('logout');

    // Settings
    Route::get('/settings/password', function () {
        return response('Password Settings Page', 200);
    })->name('settings.password');

    Route::get('/settings/appearance', function () {
        return response('Appearance Settings Page', 200);
    })->name('settings.appearance');

    Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

});





// TAMBAH INI - Admin Controllers (di root namespace)
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminRecipeController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminSaranController;
use App\Http\Controllers\Admin\AdminCommentController; // Hanya ini yang di namespace Admin

// Route admin tanpa authentication
Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('recipes', \App\Http\Controllers\Admin\RecipeController::class, ['names' => 'admin.recipes']);
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class, ['names' => 'admin.users'])->only(['index', 'show']);
    Route::get('/saran', [\App\Http\Controllers\Admin\SaranController::class, 'index'])->name('admin.saran.index');
    Route::get('/saran/{saran}', [\App\Http\Controllers\Admin\SaranController::class, 'show'])->name('admin.saran.show');
    Route::delete('/saran/{saran}', [\App\Http\Controllers\Admin\SaranController::class, 'destroy'])->name('admin.saran.destroy');
    Route::post('/saran/{saran}/mark-read', [\App\Http\Controllers\Admin\SaranController::class, 'markAsRead'])->name('admin.saran.mark-read');
    Route::get('/comments', [\App\Http\Controllers\Admin\AdminCommentController::class, 'index'])->name('admin.comments.index');
    Route::delete('/comments/{comment}', [\App\Http\Controllers\Admin\AdminCommentController::class, 'destroy'])->name('admin.comments.destroy');
});

// Memuat rute-rute bawaan Laravel Breeze
require __DIR__.'/auth.php';
