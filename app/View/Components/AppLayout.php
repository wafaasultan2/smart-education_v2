<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component {
    public $isNotDefult;
    public $name;
    public $logo;

    public function __construct(bool $isNotDefult = true) {
        $this->isNotDefult = $isNotDefult;
        $settings = Setting::whereIn('key', ['logo_path', 'name_collage'])->pluck('value', 'key');

        $this->logo = $settings['logo_path'] ?? 'default_logo.png'; // استبدل بالقيمة الافتراضية المناسبة
        $this->name = $settings['name_collage'] ?? 'Default Name'; // استبدل بالقيمة الافتراضية المناسبة
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View {
        if (!empty(request()->get('theme'))) {
            session()->put('theme', request()->get('theme'));
            session()->save();
        }
        $classes=$this->isNotDefult?'':'min-h-screen bg-gray-100 '.session('theme', 'light').':bg-gray-900';
        return view('layouts.app',['classes' => $classes ,   'name' => $this->name,
        'logo' => $this->logo]);
    }
}
