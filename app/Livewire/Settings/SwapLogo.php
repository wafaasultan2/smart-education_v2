<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class SwapLogo extends Component
{
    use WithFileUploads;

    public $logo;
    public $logo_path;
    public $progress = 0;

    public function mount()
    {
        $this->logo_path = Setting::getValue('logo_path');
    }

    public function updatedLogo()
    {
        $this->validate([
            'logo' => 'mimes:svg|max:1024', // 1MB Max, only SVG files
        ]);

        $path = $this->logo->hashName();

        // Delete the old logo if it exists
        if ($this->logo_path && Storage::disk('public')->exists($this->logo_path)) {
            Storage::disk('public')->delete($this->logo_path);
        }

        // Store the new logo with the temporary filename
        Storage::disk('public')->put($path, file_get_contents($this->logo->getRealPath()));

        Setting::setValue('logo_path', $path);
        $this->logo_path = $path;
    }

    public function render()
    {
        return view('livewire.settings.swap-logo');
    }
}
