<?php

namespace App\Patterns\State;

class PendingState extends RentalState
{
    public function approve()
    {
        $this->rental->update([
            'status' => 'Approved',
            'rental_start_at' => now(),
            'rental_due_at' => now()->addWeeks(2)
        ]);
        // Stok düşme işlemi Observer veya Controller'da yapılabilir, 
        // burada basitlik için sadece durumu güncelliyoruz.
        // İstenirse burada $this->rental->book->decrement('in_stock'); yapılabilir.
    }

    public function reject()
    {
        $this->rental->update([
            'status' => 'Rejected'
        ]);
    }

    public function cancel()
    {
        $this->rental->update([
            'status' => 'Cancelled'
        ]);
    }

    public function statusName(): string
    {
        return 'Pending Review';
    }
}
