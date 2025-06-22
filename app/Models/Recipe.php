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

    /**
     * Menghitung rata-rata rating dari comments (sistem ulasan baru)
     * Ini akan menggantikan rating yang ada di database
     */
    public function averageRating()
    {
        $average = $this->comments()->avg('rating');
        return $average ? round($average, 1) : 0;
    }

    /**
     * Total jumlah ulasan/comments
     */
    public function totalComments()
    {
        return $this->comments()->count();
    }

    /**
     * Mendapatkan rating dalam format bintang
     */
    public function getRatingStarsAttribute()
    {
        $rating = $this->averageRating();
        $stars = '';
        
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $stars .= '⭐';
            }
        }
        
        return $stars;
    }

    /**
     * Mendapatkan comments terbaru (5 terakhir)
     */
    public function recentComments($limit = 5)
    {
        return $this->comments()->limit($limit)->get();
    }

    /**
     * Cek apakah resep memiliki ulasan
     */
    public function hasComments()
    {
        return $this->comments()->exists();
    }

    /**
     * Update rating berdasarkan rata-rata comments
     * Method ini bisa dipanggil setelah ada comment baru
     */
    public function updateAverageRating()
    {
        $this->rating = $this->averageRating();
        $this->save();
    }
}