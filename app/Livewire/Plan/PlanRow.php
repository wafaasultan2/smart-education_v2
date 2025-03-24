<?php

namespace App\Livewire\Plan;

use App\Models\Department;
use App\Models\Plan;
use Livewire\Component;

class PlanRow extends Component
{
    public Plan $plan;
    public $is_active;

    public function mount()
    {
        $this->is_active = $this->plan->is_active;
    }

    public function onCahngeState()
    {
        // تحقق من صلاحية القسم
        $errorMessage = $this->validateDepartment($this->plan->department);

        if ($errorMessage) {
            $this->dispatch('changeActive', ['message' => $errorMessage, 'id' => $this->plan->id]);
            return;
        }
        $this->plan->is_active = $this->is_active;
        $this->plan->save();
    }


    public function validateDepartment($department)
    {
        $activePlans = $department->plans->where('is_active', true);

        if ($activePlans->isNotEmpty() && $this->is_active) {
            return 'القسم يحتوي على خطة مفعلة ولا يمكن تفعيل خطة أخرى.';
        }
        return null;
    }

    public function render()
    {
        return view('livewire.plan.plan-row');
    }
}
