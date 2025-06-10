<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RecipeController;

Route::get('/', [RecipeController::class, 'index'])->name('home');
Route::get('/category/{category}', [RecipeController::class, 'category'])->name('recipes.category');
Route::get('/recipe/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
Route::get('/favorites', [RecipeController::class, 'favorites'])->name('recipes.favorites');
Route::get('/search', [RecipeController::class, 'search'])->name('recipes.search');
Route::get('/api/search', [RecipeController::class, 'searchApi'])->name('recipes.search.api');

// AJAX routes
Route::post('/recipe/{recipe}/like', [RecipeController::class, 'like'])->name('recipes.like');
Route::post('/recipe/{recipe}/favorite', [RecipeController::class, 'toggleFavorite'])->name('recipes.favorite');
require __DIR__.'/auth.php';