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

    /**
     * Mevcut duruma karşılık gelen State nesnesini döndürür.
     */
    public function state(): \App\Patterns\State\RentalState
    {
        return match ($this->status) {
            'Pending Review' => new \App\Patterns\State\PendingState(),
            'Approved' => new \App\Patterns\State\ApprovedState(),
            'Returned' => new \App\Patterns\State\ReturnedState(),
            'Overdue' => new \App\Patterns\State\OverdueState(),
            'Cancelled' => new \App\Patterns\State\CancelledState(),
            'Rejected' => new \App\Patterns\State\RejectedState(),
            default => new \App\Patterns\State\PendingState(),
        };
    }

    public function getStateAttribute()
    {
        $state = $this->state();
        $state->setRental($this);
        return $state;
    }

    // State Pattern Actions
    public function approve()
    {
        $this->state->approve();
    }

    public function reject()
    {
        $this->state->reject();
    }

    public function returnBook()
    {
        $this->state->returnBook();
    }

    public function cancel()
    {
        $this->state->cancel();
    }

    public function markOverdue()
    {
        $this->state->markOverdue();
    }
}
