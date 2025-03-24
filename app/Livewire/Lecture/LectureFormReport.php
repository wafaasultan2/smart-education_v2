<?php

namespace App\Livewire\Lecture;

use App\Models\Department;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Livewire\Attributes\On;
use Livewire\Component;

class LectureFormReport extends Component
{
    public $departments = [];
    public $department_id;
    public $level;
    public $title;
    public function mount()
    {
        $this->departments = Department::get();
    }
    public function submit()
    {
        $level = mb_convert_encoding($this->level, 'UTF-8', 'auto');
        $department_id = mb_convert_encoding($this->department_id, 'UTF-8', 'auto');
        $title = mb_convert_encoding($this->title, 'UTF-8', 'auto');
        $pdf = SnappyPdf::loadView('reports.lecture-report', [
            'department_id' => $department_id,
            'level' => $level,
            'title' => $title
        ])->setPaper('A4');
        return response()->stream(function () use ($pdf) {
            echo $pdf->output();
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="custom-report.pdf"',
        ]);
    }
    public function render()
    {
        return view('livewire.lecture.lecture-form-report');
    }
}
