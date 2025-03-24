<?php

namespace App\Livewire\Course;

use App\Enums\CourseType;
use App\Models\Course;
use App\Models\Plan;
use Livewire\Component;

class CourseForm extends Component
{
    public $name;
    public $level;
    public $term;
    public $plan_ids;
    public $type;
    public $id = null;


    protected $listeners = ['edit' => 'edit'];
    public $plans;
    protected $rules = [
        'name' => 'required|string|max:255',
        'level' => 'required|in:First,Second,Third,Fourth',
        'type' => 'required|in:' . CourseType::Mandatory->value . ',' . CourseType::Specialized->value,
        'term' => 'required|in:First,Second',
        'plan_ids' => 'required|array|exists:plans,id',
    ];

    protected $messages = [
        'name.required' => 'الاسم مطلوب.',
        'name.unique' => 'الاسم موجود مسبقًا. يرجى اختيار اسم آخر.',
        'level.required' => 'المستوى مطلوب.',
        'level.in' => 'المستوى المختار غير صالح.',
        'term.required' => 'الفصل الدراسي مطلوب.',
        'term.in' => 'الفصل الدراسي المختار غير صالح.',
        'plan_ids.required' => 'الخطة الدراسية مطلوبة.',
        'plan_ids.array' => 'الخطة الدراسية المختارة غير صالحة.',
        'plan_ids.exists' => 'الخطة الدراسية المختارة غير صالحة.',
        'type.in' => 'نوع المادة غير صالح',
        'type.required' => 'نوع المادة مطلوب'
    ];

    public function submit()
    {

        $this->resetErrorBag();
        $this->rules['name'] = 'required|string|max:255|unique:courses,name,' . $this->id;
        $this->validate();
        $this->updateOrCreate();
        $this->reset();
    }

    private function updateOrCreate()
    {
        $message = '';
        $status = 'danger'; // الوضع الافتراضي هو الخطأ
        $courseId = null; // متغير لتخزين معرف القسم

        try {
            // إنشاء القسم الجديد
            $course = Course::updateOrCreate(['id' => $this->id], [
                'name' => $this->name,
                'level' => $this->level,
                'term' => $this->term,
                'type' => $this->type,
            ]);
            $course->plans()->sync($this->plan_ids);
            // تحديث الرسالة والوضع
            $message = ($this->id) ? 'تم تحديث بيانات مادة (' . $course->name . ')' : 'تم إنشاء مادة بنجاح.';
            $status = 'success';
            $courseId = $course->id; // تخزين معرف القسم
        } catch (\Illuminate\Database\QueryException $e) {
            // مشكلة في قاعدة البيانات
            $message = 'حدث خطأ أثناء إنشاء ماده. ربما توجد قيود على قاعدة البيانات.';
        } catch (\Exception $e) {
            // أي خطأ غير متوقع
            $message = 'حدث خطأ غير متوقع أثناء إنشاء مادة.';
        } finally {
            if (!$this->id) {
                $this->dispatch('courseCreated', [
                    'id' => $courseId,
                    'message' => $message,
                    'status' => $status,
                ]);
                return;
            }

            // إرسال الرسالة مع الحالة ومعرف القسم (إذا تم إنشاؤه)
            $this->dispatch('courseUpdated', [
                'id' => $courseId,
                'message' => $message,
                'status' => $status,
            ]);
        }
    }


    public function edit($course)
    {
        $this->resetErrorBag();
        $this->name = $course['name'] ?? '';
        $this->level = $course['level'] ?? '';
        $this->term = $course['term'] ?? '';
        $this->type = $course['type'] ?? '';
        $this->plan_ids = array_map(function ($plan) {
            return $plan['id'];
        }, $course['plans']);
        $this->id = $course['id'];
        $this->dispatch('showEnd', $this->plan_ids);
    }
    
    public function render()
    {
        $this->plans = Plan::active()->get();
        return view('livewire.course.course-form');
    }
}
