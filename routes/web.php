<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Auth\WelcomingController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;



Route::get('/', [RecipeController::class, 'index'])->name('home');
Route::get('/category/{category}', [RecipeController::class, 'category'])->name('recipes.category');
Route::get('/recipe/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/favorites', [RecipeController::class, 'favorites'])->name('recipes.favorites');
Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');
Route::get('/api/search', [RecipeController::class, 'searchApi'])->name('recipes.search.api');
Route::post('/recipe/{recipe}/comment', [CommentController::class, 'store'])->name('comments.store');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/keluar', function () { Auth::logout(); return redirect('/login');
});

// AJAX routes
Route::post('/recipe/{recipe}/like', [RecipeController::class, 'like'])->name('recipes.like');
Route::post('/recipe/{recipe}/favorite', [RecipeController::class, 'toggleFavorite'])->name('recipes.favorite');

//Upload Resep
Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');

// Saran routes
Route::get('/saran', [SaranController::class, 'create'])->name('saran.create');
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');


// Rute Registrasi
Route::get('/register', [RegisterController::class, 'show'])->middleware('guest')->name('register');
Route::post('/register', [RegisterController::class, 'register'])->middleware('guest');

// Memuat rute-rute bawaan Laravel Breeze
require __DIR__.'/auth.php';


// Rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    // Halaman tujuan setelah login
    Route::get('/welcoming', [WelcomingController::class, 'index'])->name('welcoming');

    // Rute untuk fitur profil Anda nanti
   // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
   // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Simple responses untuk settings routes (jika masih diperlukan)
   // Route::get('/settings/profile', function () {
    //    return response('Profile Settings Page', 200);
  //  })->name('settings.profile');

    Route::get('/settings/password', function () {
        return response('Password Settings Page', 200);
    })->name('settings.password');

    Route::get('/settings/appearance', function () {
        return response('Appearance Settings Page', 200);
    })->name('settings.appearance');
});
