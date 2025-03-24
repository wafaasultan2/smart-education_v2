<?php

namespace App\Livewire\Lecture;

use Livewire\Component;

class LectureRow extends Component
{
    public $lecture;
    public function render()
    {
        return view('livewire.lecture.lecture-row');
    }
}
