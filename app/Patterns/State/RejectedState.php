<?php

namespace App\Patterns\State;

class RejectedState extends RentalState
{
    // Reddedilmiş bir talep için başka bir geçiş yoktur.
    
    public function statusName(): string
    {
        return 'Rejected';
    }
}
