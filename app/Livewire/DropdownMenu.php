<?php

namespace App\Livewire;

use Livewire\Component;

class DropdownMenu extends Component {
    public $name;
    public $icon;
    public $active;
    public $dropdowns = [];

    public function mount($object) {
        $this->name = $object['name'];
        $this->icon = $object['icon'];
        $this->dropdowns = $object['dropdowns'] ?? [];
        $this->active = (request()->routeIs($object['route']) ?? false)?'active' : '';

    }
    public function render() {
        return view('livewire.dropdown-menu');
    }
}
