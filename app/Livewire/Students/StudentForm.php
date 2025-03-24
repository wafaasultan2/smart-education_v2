<?php

namespace App\Livewire\Students;

use App\Models\AcademicYear;
use App\Models\Department;
use Livewire\Component;

class StudentForm extends Component
{
    public $departments;
    public $plans;

    public $name;
    public  $department_id;
    public  $plan_id;
    public $description;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'department_id' => 'required|exists:departments,id',
        'plan_id' => 'required|exists:plans,id',
    ];

    protected $messages = [
        'name.required' => 'الاسم مطلوب.',
        'description.required' => 'الوصف مطلوب.',
        'department_id.required' => 'القسم مطلوب.',
        'department_id.exists' => 'القسم المختار غير صالح.',
        'plan_id.required' => 'الخطة مطلوب.',
        'plan_id.exists' => 'الخطة المختار غير صالح.',
    ];
    public function submit()
    {
        $this->validate();

        $currentYear = now()->year;
        $academicYear = AcademicYear::create([
            'name'          => $this->name,
            'description'   => $this->description,
            'department_id' => $this->department_id,
            'plan_id'       => $this->plan_id,
            'start_date'    => sprintf('%d-%d', $currentYear, $currentYear + 1),
            'end_date'      => sprintf('%d-%d', $currentYear + 3, $currentYear + 4),
            'out_date'      => now()->addYears(3),
        ]);
        $this->dispatch('studentCreated', $academicYear->id);
        $this->reset(['name', 'description', 'department_id', 'plan_id']);
    }


    public function mount()
    {
        $this->departments   = Department::with('plans')->get();
        $this->plans         = $this->departments->first()->plans ?? [];
        $this->department_id = $this->departments->first()->id ?? null;
        $this->plan_id       = $this->plans ? $this->plans->first()->id : null;
    }

    public function changeDepartment()
    {
        $selectedDepartment = $this->departments->firstWhere('id', $this->department_id);
        $this->plans        = $selectedDepartment ? $selectedDepartment->plans : [];
        $this->plan_id      = $this->plans && !empty($this->plans->items) ? $this->plans->first()->id : null;
    }



    public function render()
    {
        return view('livewire.students.student-form');
    }
}
