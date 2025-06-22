<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'user_name',
        'comment',
        'rating',
        'ip_address'
    ];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    // Remove this method - let Laravel handle Carbon automatically
}