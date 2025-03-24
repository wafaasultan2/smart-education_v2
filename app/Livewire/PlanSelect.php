<?php

namespace App\Livewire;

use App\Models\Plan;
use Livewire\Component;

class PlanSelect extends Component
{
    public $plans;
    public $plan_id;
    public $isDisabled = false;

    public function mount(){
        $this->plans=Plan::all();
    }

    public function handlePlanChange(){
        $this->isDisabled = true;
        $plan = Plan::find($this->plan_id);
        $this->dispatch('changeReport',$plan);
        $this->isDisabled = false;
    }
    public function render()
    {
        return view('livewire.plan-select',['id'=>$this->plan_id]);
    }
}
