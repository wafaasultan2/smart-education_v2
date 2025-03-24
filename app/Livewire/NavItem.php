<?php

namespace App\Livewire;

use Livewire\Component;

class NavItem extends Component
{
    public $name;
    public $route;
    public $icon;
    public $active;

    public function mount($object){
        $this->route=$object['route'];
        $this->name=$object['name'];
        $this->icon=$object['icon'];
        $this->active = (request()->routeIs($this->route) ?? false)?'active' : '';
    }
    public function render()
    {
        return view('livewire.nav-item');
    }
}
