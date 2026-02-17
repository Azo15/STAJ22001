<?php

namespace App\Patterns\State;

class OverdueState extends RentalState
{
    public function returnBook()
    {
        // Gecikmiş kitap da iade edilebilir
        $this->rental->update([
            'status' => 'Returned',
            'returned_at' => now()
        ]);
    }

    public function statusName(): string
    {
        return 'Overdue';
    }
}
