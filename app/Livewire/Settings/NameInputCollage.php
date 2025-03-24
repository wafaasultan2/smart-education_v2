<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use App\Models\Setting;

class NameInputCollage extends Component
{
    public $name_collage;

    public function mount()
    {
        $this->name_collage = Setting::getValue("name_collage", "");
    }

    public function createOrUpdate()
    {
        $this->name_collage = trim($this->name_collage);

        $this->validate([
            'name_collage' => 'required|string|max:255',
        ], [
            'name_collage.required' => 'حقل اسم الكلية مطلوب.',
            'name_collage.string' => 'حقل اسم الكلية يجب أن يكون نصاً.',
            'name_collage.max' => 'حقل اسم الكلية يجب ألا يتجاوز 255 حرفاً.',
        ]);

        Setting::setValue('name_collage', $this->name_collage);
    }

    public function render()
    {
        return view('livewire.settings.name-input-collage');
    }
}
