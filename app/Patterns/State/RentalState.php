<?php

namespace App\Patterns\State;

use App\Models\Rental;
use Exception;

abstract class RentalState
{
    /**
     * @var Rental
     */
    protected $rental;

    /**
     * @param Rental $rental
     */
    public function setRental(Rental $rental)
    {
        $this->rental = $rental;
    }

    // Default implementations throw exception, specific states will override allowed transitions
    
    public function approve()
    {
        throw new Exception("Bu durumdan 'Onaylandı' durumuna geçiş yapılamaz.");
    }

    public function reject()
    {
        throw new Exception("Bu durumdan 'Reddedildi' durumuna geçiş yapılamaz.");
    }

    public function returnBook()
    {
        throw new Exception("Bu durumdan 'İade Edildi' durumuna geçiş yapılamaz.");
    }

    public function cancel()
    {
        throw new Exception("Bu durumdan 'İptal Edildi' durumuna geçiş yapılamaz.");
    }

    public function markOverdue()
    {
        throw new Exception("Bu durumdan 'Gecikmiş' durumuna geçiş yapılamaz.");
    }

    abstract public function statusName(): string;
}
