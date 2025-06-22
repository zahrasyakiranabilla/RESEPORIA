<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category',
        'rating',
        'likes',
        'cooking_time',
        'ingredients',
        'instructions',
        'video_url',
        'status',
    ];

    protected $casts = [
        'ingredients' => 'array',
        'instructions' => 'array',
        'rating' => 'decimal:1'
    ];

    /**
     * Relationship dengan favorites
     */
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    /**
     * Relationship dengan comments (sistem ulasan baru)
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->latest();
    }

    /**
     * Format cooking time dengan 'm'
     */
    public function getCookingTimeFormatAttribute()
    {
        return $this->cooking_time . 'm';
    }

    /**
     * Scope untuk filter berdasarkan kategori
     */
    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    /**
     * Scope untuk pencarian
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
    }

    /**
     * Cek apakah resep sudah difavoritkan berdasarkan session
     */
    public function isFavoritedBy($sessionId)
    {
        return $this->favorites()->where('session_id', $sessionId)->exists();
    }
}