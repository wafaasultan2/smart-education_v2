<?php

namespace App\Livewire\Hall;

use Livewire\Component;

class HallRow extends Component
{
    public $hall;
    public function render()
    {
        return view('livewire.hall.hall-row');
    }
}
