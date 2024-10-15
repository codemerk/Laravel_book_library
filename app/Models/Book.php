<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['title', 'authors', 'isbn', 'pages', 'language_code', 'in_stock', 'description', 'cover_image', 'released_at', 'genre_id'];
    protected $dates = ['released_at'];
    protected $casts = [
        'released_at' => 'datetime',
    ];

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }
    public function borrows() {
        return $this->hasMany(Borrow::class, 'book_id');
    }

    // Business method to get active borrows
    public function activeBorrows() {
        return $this->borrows()->where('status', '=', 'ACCEPTED');
    }
    

    // Add other necessary methods or relationships
}

