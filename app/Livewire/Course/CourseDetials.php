<?php

namespace App\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class CourseDetials extends Component
{
    public Course $course;

    protected $listeners = ['showCourse' => 'show'];

    public function show($id)
    {
        $message = '';
        $status = '500';
        try {
            $this->course = Course::findOrFail($id);
            $message = 'تم العثور على القسم بنجاح.';
            $status = '200';
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $message = 'القسم المطلوب غير موجود.';
        } catch (\Exception $e) {
            $message = 'حدث خطأ غير متوقع.';
        } finally {
            $this->dispatch('courseRetrieved', ['message' => $message, 'status' => $status]);
        }
    }
    public function render()
    {
        return view('livewire.course.course-detials');
    }
}
