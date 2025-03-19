<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Add 'main_image' to the fillable array
    protected $fillable = ['title', 'content', 'user_id', 'main_image'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
