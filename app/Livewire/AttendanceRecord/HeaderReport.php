<?php

namespace App\Livewire\AttendanceRecord;

use App\Models\Setting;
use Livewire\Component;

class HeaderReport extends Component
{
    public $name;
    public $logo;

    public function mount() {
        $settings = Setting::whereIn('key', ['logo_path', 'name_collage'])->pluck('value', 'key');

        $this->logo = $settings['logo_path'] ?? 'default_logo.png'; // استبدل بالقيمة الافتراضية المناسبة
        $this->name = $settings['name_collage'] ?? 'Default Name'; // استبدل بالقيمة الافتراضية المناسبة
    }

    public function render()
    {
        return view('livewire.attendance-record.header-report');
    }
}
