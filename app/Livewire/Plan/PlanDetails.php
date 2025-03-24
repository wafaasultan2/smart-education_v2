<?php

namespace App\Livewire\Plan;

use App\Models\Plan;
use Livewire\Component;

class PlanDetails extends Component
{
    public Plan $plan;

    protected $listeners = ['showPlan' => 'show'];

    public function show($id)
    {
        $message = '';
        $status = '500';
        try {
            $this->plan = Plan::findOrFail($id);
            $message = 'تم العثور على الخطة بنجاح.';
            $status = '200';
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $message = 'الخطة المطلوب غير موجود.';
        } catch (\Exception $e) {
            $message = 'حدث خطأ غير متوقع.';
        } finally {
            $this->dispatch('PlanRetrieved', ['message' => $message, 'status' => $status]);
        }
    }
    public function render()
    {
        return view('livewire.plan.plan-details');
    }
}
