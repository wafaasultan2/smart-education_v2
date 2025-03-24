<?php

namespace App\Livewire\User;

use Livewire\Component;

class UserCard extends Component
{
    public $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function ban()
    {
        $this->user->update(['ban' => !$this->user->ban]);
        
    }
    public function render()
    {
        return view('livewire.user.user-card');
    }
}
