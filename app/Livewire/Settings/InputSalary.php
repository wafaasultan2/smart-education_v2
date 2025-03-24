<?php

namespace App\Livewire\Settings;

use App\Enums\AcademicDegree;
use App\Models\Setting;
use Livewire\Component;

class InputSalary extends Component
{
    public $listSalary = [];

    public function mount()
    {
        $salaries = Setting::whereIn('key', AcademicDegree::cases())->get()->keyBy('key');
        foreach (AcademicDegree::cases() as $degree) {
            $this->listSalary[$degree->value] = $salaries[$degree->value]->value ?? '';
        }
    }

    public function createOrUpdate($degree)
    {
        $this->validate([
            "listSalary.$degree" => 'required|numeric',
        ], [
            "listSalary.$degree.required" => 'حقل سعر الساعة مطلوب.',
            "listSalary.$degree.numeric" => 'حقل سعر الساعة يجب أن يكون رقماً.',
        ]);

        Setting::updateOrCreate(
            ['key' => $degree],
            ['value' => $this->listSalary[$degree]]
        );
    }

    public function render()
    {
        return view('livewire.settings.input-salary');
    }
}
