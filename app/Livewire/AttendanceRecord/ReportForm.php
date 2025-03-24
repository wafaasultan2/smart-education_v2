<?php

namespace App\Livewire\AttendanceRecord;

use Barryvdh\Snappy\Facades\SnappyPdf;
use Livewire\Attributes\On;
use Livewire\Component;

class ReportForm extends Component
{
    public $fromDate;
    public $toDate;
    public $title;

    #[On('submitEvent')]
    public function submit($fromDate, $toDate, $title)
    {
        $this->title = mb_convert_encoding($title, 'UTF-8', 'auto');
        $this->fromDate = mb_convert_encoding($fromDate, 'UTF-8', 'auto');
        $this->toDate = mb_convert_encoding($toDate, 'UTF-8', 'auto');

        $this->validate(
            [
                'fromDate' => 'required|date',
                'toDate' => 'required|date|after_or_equal:fromDate',
                'title' => 'required|string|max:255',
            ],
            [
                'fromDate.required' => 'حقل تاريخ البداية مطلوب.',
                'toDate.required' => 'حقل تاريخ النهاية مطلوب.',
                'toDate.after_or_equal' => 'يجب أن يكون تاريخ النهاية أكبر من أو يساوي تاريخ البداية.',
                'title.required' => 'حقل العنوان مطلوب.',
            ],
        );
        // تحميل الـ PDF باستخدام SnappyPdf
        $pdf = SnappyPdf::loadView('reports.attendance-record-report', [
            'fromDate' => $this->fromDate,
            'toDate' => $this->toDate,
            'title' => $this->title,
        ])->setPaper('A4');
        $this->reset();
        // تحميل الملف مباشرة بعد التقديم
        return response()->stream(function () use ($pdf) {
            echo $pdf->output();
        }, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="custom-report.pdf"',
        ]);
    }

    public function render()
    {
        return view('livewire.attendance-record.report-form');
    }
}
