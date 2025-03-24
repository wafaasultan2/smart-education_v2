<?php

namespace App\Livewire\Lecture;

use App\Models\ClassRoom;
use Livewire\Component;
use App\Enums\Days;
use App\Enums\TimeLecture;

class LectureSelectClassroom extends Component
{
    public $classRooms;
    protected $listeners = ['toggle' => 'toggle'];

    public function mount()
    {
        $this->classRooms = ClassRoom::whereDoesntHave('lectures', function ($query) {
            $query->where('day', Days::Saturday->value)
                ->where('time_lecture', TimeLecture::EIGHT_TO_TEN->value);
        })->get();
    }

    public function toggle($query)
    {
        $selectedDay = Days::from($query['day']);
        $selectedTime = TimeLecture::from($query['time']);

        $this->classRooms = ClassRoom::whereDoesntHave('lectures', function ($query) use ($selectedDay, $selectedTime) {
            $query->where('day', $selectedDay->value)
                ->where('time_lecture', $selectedTime->value);
        })->get();
    }

    public function render()
    {
        return view('livewire.lecture.lecture-select-classroom');
    }
}
