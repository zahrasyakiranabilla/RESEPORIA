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
        'video_url'
    ];

    protected $casts = [
        'ingredients' => 'array',
        'rating' => 'decimal:1'
    ];

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

  public function getCookingTimeFormatAttribute()
{
    return $this->cooking_time . 'm';
}

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('title', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
    }

    public function isFavoritedBy($sessionId)
    {
        return $this->favorites()->where('session_id', $sessionId)->exists();
    }
}