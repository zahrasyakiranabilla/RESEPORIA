@extends('layouts.app')

@section('content')
<!-- Header -->
<header class="header">
    <div class="header-container">
        <a href="/" class="logo">Reseporia</a>
        <div class="header-right">
            <a href="/favorites" class="favorites-link">❤️</a>
            <div class="auth-buttons">
                <a href="/login" class="btn-login">Login</a>
                <a href="/register" class="btn-register">Register</a>
            </div>
        </div>
    </div>
</header>

<!-- Search Section -->
<section class="search-section">
    <div class="search-container">
        <form class="search-form" action="/" method="GET">
            <input type="text" name="search" class="search-input" placeholder="Cari resep kesukaanmu..." value="{{ request('search') }}">
            <button type="submit" class="search-btn">🔍</button>
        </form>
    </div>
</section>

<!-- Main Content -->
<main class="main-content">
    <!-- Banner -->
    <div class="banner">
        <h1 class="banner-title">SAJIAN UTAMA,</h1>
        <h2 class="banner-subtitle">CITA RASA ISTIMEWA</h2>
        <p class="banner-tagline">MAKE YOUR OWN FOOD!</p>
    </div>

    <!-- Category Filters -->
    <div class="category-filters">
        <a href="/category/appetizer" class="category-btn {{ request()->is('category/appetizer') ? 'active' : '' }}">Appetizer</a>
        <a href="/category/main-course" class="category-btn {{ request()->is('category/main-course') ? 'active' : '' }}">Main Course</a>
        <a href="/category/dessert" class="category-btn {{ request()->is('category/dessert') ? 'active' : '' }}">Dessert</a>
        <a href="/category/drinks" class="category-btn {{ request()->is('category/drinks') ? 'active' : '' }}">Drinks</a>
    </div>

    <!-- Recipes Grid -->
    <div class="recipes-grid">
        @foreach($recipes as $recipe)
        <div class="recipe-card">
            <a href="/recipe/{{ $recipe->id }}" class="recipe-link">
                <img src="{{ $recipe->image ?? '/images/recipes/placeholder.jpg' }}" alt="{{ $recipe->name }}" class="recipe-image">
                <div class="recipe-content">
                    <h3 class="recipe-title">{{ $recipe->name }}</h3>
                    <div class="recipe-meta">
                        <div class="recipe-rating">
                            <span class="star">⭐</span>
                            <span>{{ $recipe->rating ?? '4.5' }}</span>
                        </div>
                        <div class="recipe-likes">
                            <span class="heart">❤️</span>
                            <span>{{ $recipe->likes ?? '0' }}</span>
                        </div>
                        <div class="recipe-time">
                            <span>⏱️</span>
                            <span>{{ $recipe->cooking_time ?? '30m' }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</main>
@endsection