<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Books extends Model
{
    use HasFactory;

    // Kitap modelinde toplu atamaya izin verilen alanlar
    protected $fillable = [
        'title',
        'author',
        'release_date',
        'pages',
        'isbn',
        'description',
        'genre',
        'in_stock',
        'cover',
        'language',
    ];

    /**
     * Kitabın birden fazla türe ait olabileceğini tanımlar.
     */
    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'book_genre', 'book_id', 'genre_id');
    }

    /**
     * Kitabın birden fazla Ödünç Alma kaydına sahip olabileceğini tanımlar.
     */
    public function rentals(): HasMany
    {
        return $this->hasMany(Rental::class, 'books_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'books_id');
    }
}
