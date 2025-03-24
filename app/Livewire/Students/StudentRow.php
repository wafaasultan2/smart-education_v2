<?php

namespace App\Livewire\Students;

use Livewire\Component;

class StudentRow extends Component
{
    public $student;
    public function render()
    {
        return view('livewire.students.student-row');
    }
}
