<?php

namespace App\Livewire\Plan;

use App\Models\Department;
use App\Models\Plan;
use Livewire\Component;

class PlanForm extends Component
{
    public $name;
    public $department_id;
    public $description;

    public $departments;

    protected $rules = [
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'department_id' => 'required|exists:departments,id',
    ];

    protected $messages = [
        'name.required' => 'الاسم مطلوب.',
        'description.required' => 'الوصف مطلوب.',
        'department_id.required' => 'القسم مطلوب.',
        'department_id.exists' => 'القسم المختار غير صالح.',
    ];
    public function submit()
    {
        $this->validate();
        // تحقق من صلاحية القسم
        $errorMessage = $this->validateDepartment($this->department_id);

        if ($errorMessage) {
            $this->addError('department_id', $errorMessage);
            return;
        }

        $plan = Plan::create([
            'name' => $this->name,
            'description' => $this->description,
            'department_id' => $this->department_id,
        ]);

        $this->dispatch('planCreated', $plan->id);
        $this->reset();
    }


    public function validateDepartment($departmentId)
    {
        $department = Department::with('plans')->find($departmentId);
        if (!$department) {
            return 'القسم غير موجود.';
        }
        if (!$department->is_active) {
            return 'القسم غير نشط.';
        }
        $activePlans = $department->plans->where('is_active', true);

        if ($activePlans->isNotEmpty()) {
            return 'القسم يحتوي على خطط مفعلة ولا يمكن إضافة خطة جديدة.';
        }
        return null;
    }

    public function render()
    {
        $this->departments = Department::where('is_active', true)
            ->whereDoesntHave('plans', function ($query) {
                $query->where('is_active', true);
            })
            ->get() ?? [];
        return view('livewire.plan.plan-form');
    }
}
