<?php

namespace App\Livewire\Teacher;

use App\Models\Teacher;
use Livewire\Component;

class TeacherCard extends Component
{
    public Teacher $teacher;

    public function mount(Teacher $teacher)
    {
        $this->teacher = $teacher;
    }

    // toggle the teacher status
    public function toggleStatus()
    {
        $this->teacher->status = !$this->teacher->status;
        $this->teacher->save();
    }
    public function render()
    {
        return view('livewire.teacher.teacher-card');
    }
}
