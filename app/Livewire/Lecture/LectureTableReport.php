<?php

namespace App\Livewire\Lecture;

use App\Enums\Days;
use App\Enums\Levels;
use App\Models\Lecture;
use Livewire\Component;

class LectureTableReport extends Component
{
    public $lectures = [];
    public $title='';

    public function mount($departmentId, $level, $title='')
    {
        $this->lectures = Lecture::where('department_id', $departmentId)
            ->whereHas('course', function ($query) use ($level) {
                $query->where('level', $level);
            })
            ->with(['teacher', 'course', 'classRoom'])
            ->orderByRaw("FIELD(day, 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday')")
            ->orderBy('time_lecture')
            ->get()
            ->groupBy('day')
            ->mapWithKeys(function ($lectures, $day) {
                return [Days::from($day)->getValue() => $lectures];
            });
    }

    public function render()
    {
        return view('livewire.lecture.lecture-table-report');
    }
}
