<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;
use Illuminate\View\View;

class ReportLayout extends Component {
    public $name;
    public $logo;

    public function __construct() {
        $settings = Setting::whereIn('key', ['logo_path', 'name_collage'])->pluck('value', 'key');

        $this->logo = $settings['logo_path'] ?? 'default_logo.png'; // استبدل بالقيمة الافتراضية المناسبة
        $this->name = $settings['name_collage'] ?? 'Default Name'; // استبدل بالقيمة الافتراضية المناسبة
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View {
        return view('layouts.report', [
            'name' => $this->name,
            'logo' => $this->logo
        ]);

    }
}
