<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\SaranController;
use App\Http\Controllers\RegisterController;

Route::get('/', [RecipeController::class, 'index'])->name('home');
Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::get('/category/{category}', [RecipeController::class, 'category'])->name('recipes.category');
Route::get('/recipe/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/favorites', [RecipeController::class, 'favorites'])->name('recipes.favorites');
Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');
Route::get('/api/search', [RecipeController::class, 'searchApi'])->name('recipes.search.api');
Route::get('/register', [RegisterController::class, 'show'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit');


// AJAX routes
Route::post('/recipe/{recipe}/like', [RecipeController::class, 'like'])->name('recipes.like');
Route::post('/recipe/{recipe}/favorite', [RecipeController::class, 'toggleFavorite'])->name('recipes.favorite');

// Saran routes
Route::get('/saran', [SaranController::class, 'create'])->name('saran.create');
Route::post('/saran', [SaranController::class, 'store'])->name('saran.store');

Route::get('/force-logout', function () {
    \Illuminate\Support\Facades\Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});

require __DIR__.'/auth.php';

// Protected routes that require authentication
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Simple responses untuk settings routes (tanpa view files)
    Route::get('/settings/profile', function () {
        return response('Profile Settings Page', 200);
    })->name('settings.profile');

    Route::get('/settings/password', function () {
        return response('Password Settings Page', 200);
    })->name('settings.password');

    Route::get('/settings/appearance', function () {
        return response('Appearance Settings Page', 200);
    })->name('settings.appearance');
});
