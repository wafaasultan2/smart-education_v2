<?php

namespace App\Livewire;

use App\Enums\Terms;
use App\Models\Course;
use App\Models\Plan;
use Livewire\Component;

class TableReportPlan extends Component
{
    public $tableReport;
    protected $listeners = ['changeReport' => 'newReport'];

    public function newReport(Plan $plan)
    {
        $this->tableReport = [];
        if ($plan && !empty($plan)) {
            $plan->courses->filter(function ($course) {
                $this->tableReport[$course->level][$course->term][] = $course;
                return null;
            });
        }
        $this->handleReport();
        
    }
    public function mount()
    {
        $courses = Plan::first()->courses ?? [];
        if ($courses) {
            $courses->filter(function ($course) {
                $this->tableReport[$course->level][$course->term][] = $course;
                return null;
            });
        }

        $this->handleReport();
    }

    private function handleReport()
    {
        $this->tableReport = $this->tableReport ?: [];
        foreach ($this->tableReport as $level => $terms) {
            $this->tableReport[$level] = $this->fillArrayWithNulls($terms[Terms::First->value] ?? [], $terms[Terms::Second->value] ?? []);
        }
    }

    private function fillArrayWithNulls($first, $second)
    {
        $diff = abs(count($second) - count($first));
        for ($i = 0; $i < $diff; $i++) {
            if (count($second) > count($first)) {
                $first[] = new Course();
            } else {
                $second[] = new Course();
            }
        }
        return [Terms::First->value => $first, Terms::Second->value => $second];
    }

    public function render()
    {
        return view('livewire.table-report-plan');
    }
}
