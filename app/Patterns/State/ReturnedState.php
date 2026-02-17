<?php

namespace App\Patterns\State;

class ReturnedState extends RentalState
{
    // İade edilmiş bir kitap için başka bir geçiş yoktur.
    // Tüm metodlar varsayılan olarak Exception fırlatır.

    public function statusName(): string
    {
        return 'Returned';
    }
}
