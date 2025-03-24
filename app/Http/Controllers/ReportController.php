<?php

namespace App\Http\Controllers;

use App\Models\AttendanceRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function downloadPDF()
    {
        $pdf = SnappyPdf::loadView('reports.attendance-record-report')
            ->setPaper('A4');
        return $pdf->download('custom-report.pdf');
        // return view('reports.attendance-record-report');
    }
}
