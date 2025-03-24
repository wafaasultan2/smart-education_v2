<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Component;

class DepartmentRow extends Component
{
    public Department $department;
    public $is_active;

    protected $listeners = ['departmentUpdated' => 'departmentUpdated'];
    public function mount()
    {
        $this->is_active = $this->department->is_active;
    }

    public function onCahngeState()
    {
        $this->department->is_active = $this->is_active;
        $this->department->save();
    }

    public function editShow()
    {
        $this->dispatch('edit', $this->department);
    }

    public function departmentUpdated()
    {
        $this->department->refresh();
    }

    public function render()
    {
        return view('livewire.department.department-row');
    }
}
