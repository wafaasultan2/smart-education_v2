<?php

namespace App\Livewire;

use Livewire\Component;

class DropdownItem extends Component
{
    public $name;
    public $route;

    public function mount($name,$route){
        $this->route=$route;
        $this->name=$name;
    }
    public function render()
    {
        return view('livewire.dropdown-item');
    }
}
