<?php

namespace App\Livewire\Lecture;

use App\Models\AcademicYear;
use App\Models\ClassRoom;
use App\Models\Course;
use App\Models\lecture;
use App\Models\Teacher;
use App\Models\Year;
use Livewire\Component;
use App\Enums\TimeLecture;
use App\Enums\Days;
use App\Enums\TypeLecture;
use App\Models\Department;

class LectureForm extends Component
{
    public $id = null;
    public $name;
    public $time_lecture;
    public $group;
    public $type;
    public $day;
    public $students;
    public $course;
    public $teacher;
    public $classroom_id;
    public $department_id;

    //  model
    public $courses;
    public $academic_years;
    public $teachers;
    public $classRooms;
    public $departments;

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'time_lecture' => 'required|in:' . implode(',', array_column(TimeLecture::cases(), 'value')),
            'group' => 'required|int',
            'type' => 'required|in:' . implode(',', array_column(TypeLecture::cases(), 'value')),
            'day' => 'required|in:' . implode(',', array_column(Days::cases(), 'value')),
            'students' => 'required|exists:academic_years,id',
            'course' => 'required|exists:courses,id',
            'teacher' => 'required|exists:teachers,id',
            'classroom_id' => 'required|exists:class_rooms,id',
            'department_id' => 'nullable|exists:departments,id',
        ];
    }

    protected function messages()
    {
        return [
            'name.required' => 'اسم المحاضرة مطلوب.',
            'name.string' => 'اسم المحاضرة يجب أن يكون نصاً.',
            'name.max' => 'اسم المحاضرة يجب ألا يتجاوز 255 حرفاً.',
            'time_lecture.required' => 'وقت المحاضرة مطلوب.',
            'time_lecture.in' => 'وقت المحاضرة غير صالح.',
            'group.required' => 'المجموعة مطلوبة.',
            'group.int' => 'المجموعة يجب أن تكون رقماً.',
            'type.required' => 'نوع المحاضرة مطلوب.',
            'type.in' => 'نوع المحاضرة غير صالح.',
            'day.required' => 'اليوم مطلوب.',
            'day.in' => 'اليوم غير صالح.',
            'students.required' => 'الطلاب مطلوب.',
            'students.exists' => 'الطلاب غير صالح.',
            'course.required' => 'الدورة مطلوبة.',
            'course.exists' => 'الدورة غير صالحة.',
            'teacher.required' => 'المعلم مطلوب.',
            'teacher.exists' => 'المعلم غير صالح.',
            'classroom_id.required' => 'الغرفة مطلوبة.',
            'classroom_id.exists' => 'الغرفة غير صالحة.',
            'department_id.exists' => 'القسم غير صالح.',


        ];
    }

    public function submit()
    {
        $this->resetErrorBag();
        $this->validate($this->rules(), $this->messages());
        $this->updateOrCreate();
        $this->reset();
        $this->init();
    }

    private function updateOrCreate()
    {
        $message = '';
        $eventName = 'lectureCreated';
        $status = 'danger';
        $lectureId = null;

        try {
            $year = Year::active()?->show()->first();

            if (!$year) {
                throw new \Exception('يجب تحديد العام بشكل صريح قبل إضافة المحاضرة.');
            }
            $lecture = Lecture::updateOrCreate(['id' => $this->id], [
                'name' => $this->name,
                'time_lecture' => $this->time_lecture,
                'group' => $this->group,
                'type' => $this->type,
                'day' => $this->day,
                'academic_year_id' => $this->students,
                'course_id' => $this->course,
                'teacher_id' => $this->teacher,
                'classroom_id' => $this->classroom_id,
                'term' => $year->terms->where('is_active', true)->first()?->id,
                'year' => $year->id,
                'department_id' => $this->department_id,
            ]);
            $message = ($this->id) ? 'تم تحديث بيانات المحاضره (' . $lecture->name . ')' : 'تم إنشاء المحاضره بنجاح.';
            $status = 'success';
            $eventName = $lecture->wasRecentlyCreated ? 'lectureCreated' : 'lectureUpdated';
            $lectureId = $lecture->id;
        } catch (\Illuminate\Database\QueryException $e) {
            $message = 'حدث خطأ أثناء إنشاء المحاضره. ربما توجد قيود على قاعدة البيانات.';
        } catch (\Exception $e) {
            // أي خطأ غير متوقع
            $message = $e->getMessage() ?: 'حدث خطأ غير متوقع أثناء إنشاء المحاضره.';
        } finally {
            $this->dispatch($eventName, [
                'id' => $lectureId,
                'message' => $message,
                'status' => $status,
            ]);
        }
    }


    public function toggleClassRoom()
    {
        $selectedDay = Days::from($this->day ?? Days::Saturday->value);
        $selectedTime = TimeLecture::from($this->time_lecture ?? TimeLecture::EIGHT_TO_TEN->value);
        $this->classRooms = ClassRoom::whereDoesntHave('lectures', function ($query) use ($selectedDay, $selectedTime) {
            $query->forActiveYearAndTerm()
                ->where('day', $selectedDay->value)
                ->where('time_lecture', $selectedTime->value);
        })->get();
    }

    //toggle department for course
    public function toggleDepartment()
    {
        $this->departments = Department::with(['plans.courses' => function ($query) {
            $query->where('courses.id', $this->course);
        }])->whereHas('plans.courses', function ($query) {
            $query->where('courses.id', $this->course);
        })->get();
    }

    public function mount()
    {
        // جلب كل القاعات التي لا تتكرر 4 في نفس term و year
        $this->init();
    }

    public function init()
    {
        $this->courses = Course::get();
        $this->academic_years = AcademicYear::get();
        $this->teachers = Teacher::get();
        $this->classRooms = ClassRoom::whereDoesntHave('lectures', function ($query) {
            $query->forActiveYearAndTerm()
                ->where('day', Days::Saturday->value)
                ->where('time_lecture', TimeLecture::EIGHT_TO_TEN->value);
        })->get();
        $this->toggleDepartment();
    }
    public function render()
    {
        return view('livewire.lecture.lecture-form');
    }
}
