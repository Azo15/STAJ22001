<?php

namespace App\Patterns\State;

class ApprovedState extends RentalState
{
    public function returnBook()
    {
        $this->rental->update([
            'status' => 'Returned',
            'returned_at' => now()
        ]);
        // İstenirse burada $this->rental->book->increment('in_stock'); yapılabilir.
    }

    public function markOverdue()
    {
        $this->rental->update([
            'status' => 'Overdue'
        ]);
    }

    public function statusName(): string
    {
        return 'Approved';
    }
}
