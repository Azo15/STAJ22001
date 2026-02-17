<?php

namespace App\Patterns\State;

class CancelledState extends RentalState
{
    // İptal edilmiş bir talep için başka bir geçiş yoktur.

    public function statusName(): string
    {
        return 'Cancelled';
    }
}
