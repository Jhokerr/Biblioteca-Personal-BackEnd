<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'description',
        'genre',
        'published_year',
        'pages',
        'cover_url',
        'reading_status',
        'user_id',
    ];

    // Relación con el usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}