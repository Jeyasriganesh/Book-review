<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_title',  
        'author_name', 
        'rating',   
        'review_date', 
    ];

    
    protected $table = 'book_reviews';

    
    protected $attributes = [
        'review_date' => null, 
    ];

    
    protected $casts = [
        'rating' => 'integer',
        'review_date' => 'date',
    ];

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
