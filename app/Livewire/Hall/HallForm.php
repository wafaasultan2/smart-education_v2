<?php

namespace App\Livewire\Hall;

use App\Models\ClassRoom;
use Livewire\Component;

class HallForm extends Component
{
    public $name;
    public $capacity;
    public $is_screen = false;
    public $description;

    protected $rules = [
        'name' => 'required|string|max:255',
        'capacity' => 'required|integer|min:1',
        'is_screen' => 'boolean',
        'description' => 'nullable|string|max:255',
    ];

    protected $messages = [
        'name.required' => 'اسم القاعة مطلوب.',
        'capacity.required' => 'السعة مطلوبة.',
        'capacity.integer' => 'السعة يجب أن تكون عدد صحيح.',
        'capacity.min' => 'السعة يجب أن تكون على الأقل 1.',
        'description.max' => 'الوصف يجب ألا يتجاوز 255 حرفًا.',
    ];

    public function submit()
    {
        $this->validate();

        $hall = ClassRoom::create([
            'name' => $this->name,
            'capacity' => $this->capacity,
            'is_screen' => $this->is_screen,
            'description' => $this->description,
        ]);
        $this->dispatch('hallCreated', $hall->id);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.hall.hall-form');
    }
}
