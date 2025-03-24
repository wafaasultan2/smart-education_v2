<?php

namespace App\Livewire\Course;

use Livewire\Component;

class CourseRow extends Component
{
    public $course;
    protected $listeners = ['courseUpdated' => 'courseUpdated'];
    public function editShow()
    {
        $this->dispatch('edit', $this->course);
    }

    public function courseUpdated()
    {
        $this->course->refresh();
    }
    public function render()
    {
        return view('livewire.course.course-row');
    }
}
