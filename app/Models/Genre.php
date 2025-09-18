<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Books;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Genre extends Model
{
    use HasFactory;

    // Tür modelinde toplu atamaya izin verilen alanlar
    protected $fillable = [
        'name',
        'style',
    ];

    /**
     * Türün birden fazla kitaba ait olabileceğini tanımlar.
     */
    public function books()
    {
        return $this->belongsToMany(Books::class, 'book_genre', 'genre_id', 'book_id');
    }
}
