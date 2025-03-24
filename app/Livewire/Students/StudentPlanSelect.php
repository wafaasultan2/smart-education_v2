<?php

namespace App\Livewire\Students;

use Livewire\Component;

class StudentPlanSelect extends Component
{
    public $plans;
    protected $listeners = ['changeDepartment' => 'setPlans'];

    public function setPlans($department_id)
    {
        $this->plans = \App\Models\Plan::with('department')
            ->where('department_id', $department_id)
            ->get();
    }

    public function render()
    {
        return view('livewire.students.student-plan-select');
    }
}
