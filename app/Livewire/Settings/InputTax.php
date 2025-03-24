<?php

namespace App\Livewire\Settings;

use App\Models\Setting;
use Livewire\Component;

class InputTax extends Component
{
    // model tax and role validation and message
    public $tax = 0.1;
    protected $rules = [
        'tax' => 'required|numeric|min:0|max:100',
    ];
    protected $messages = [
        'tax.required' => 'الضريبة مطلوبة.',
        'tax.numeric' => 'الضريبة يجب أن تكون رقماً.',
        'tax.min' => 'الضريبة يجب أن لا تقل عن 0.',
        'tax.max' => 'الضريبة يجب أن لا تزيد عن 100.',
    ];

    public function createOrUpdate()
    {
        $this->validate();
        Setting::setValue('tax', $this->tax / 100);
    }

    public function mount()
    {
        $this->tax = Setting::getValue('tax', $this->tax) * 100;
    }

    public function render()
    {
        return view('livewire.settings.input-tax');
    }
}
