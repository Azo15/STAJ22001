<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    use HasFactory;

    // Tarih alanlarını otomatik olarak datetime nesnesine dönüştür
    protected $casts = [
        'rental_requested_at' => 'datetime',
        'rental_start_at' => 'datetime',
        'rental_due_at' => 'datetime',
        'returned_at' => 'datetime',
    ];    

    // Toplu atamaya izin verilen alanlar
    protected $fillable = [
        'user_id',
        'books_id',
        'status', // 'status' değeri 'Pending Review', 'Approved', 'Returned', 'Overdue', 'Cancelled' olabilir
        'rental_requested_at',
        'rental_start_at', // 'rental_start_at' kitabın kütüphaneci veya admin tarafından onaylandığı zaman damgasıdır
        'rental_due_at',
        'returned_at',
    ];

    /**
     * Ödünç Almanın ait olduğu kitabı tanımlar.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Books::class, 'books_id');
    }

    /**
     * Ödünç Almanın ait olduğu kullanıcıyı tanımlar.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
