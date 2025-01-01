<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookReview extends Model
{
    use HasFactory;

    // Specify which attributes can be mass-assigned
    protected $fillable = [
        'book_title',  // Title of the book being reviewed
        'author_name', // Author of the book
        'rating',      // Rating (1-5)
        'review_date', // Date of the review (defaults to current date)
    ];

    // Define the table associated with the model if needed (optional)
    protected $table = 'book_reviews';

    // If you want to set a default value for review_date to current date
    protected $attributes = [
        'review_date' => null, // Use database default if null
    ];

    // Optionally, if you want to cast some fields, for example, casting rating to an integer
    protected $casts = [
        'rating' => 'integer',
        'review_date' => 'date',
    ];

    // Optionally, if you need to define a custom timestamp (if you don't use Laravel's default created_at/updated_at)
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
}
