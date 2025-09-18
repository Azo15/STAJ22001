<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Bileşeni temsil eden görünümü / içeriği getir.
     */
    public function render(): View
    {
        return view('layouts.guest');
    }
}
