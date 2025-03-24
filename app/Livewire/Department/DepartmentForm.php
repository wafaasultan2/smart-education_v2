<?php

namespace App\Livewire\Department;

use App\Enums\AcademicDegree;
use Livewire\Component;
use App\Models\Department;
use App\Models\Setting;

class DepartmentForm extends Component
{
    public $name;
    public $description;
    public $PROFESSOR;
    public $ASSOCIATE_PROFESSOR;
    public $ASSISTANT_PROFESSOR;
    public $LECTURER;
    public $TEACHING_ASSISTANT;

    public $id = null;

    protected $listeners = ['edit' => 'edit'];

    // قواعد التحقق
    protected $rules = [
        'name' => 'required|string|max:255|unique:departments,name',
        'description' => 'required|string|max:255',
    ];

    // رسائل التحقق
    protected $messages = [
        'name.required' => 'الاسم مطلوب.',
        'name.string' => 'الاسم يجب أن يكون نصًا.',
        'name.max' => 'الاسم يجب ألا يتجاوز 255 حرفًا.',
        'name.unique' => 'الاسم موجود مسبقًا. يرجى اختيار اسم آخر.',

        'description.required' => 'الوصف مطلوب.',
        'description.string' => 'الوصف يجب أن يكون نصًا.',
        'description.max' => 'الوصف يجب ألا يتجاوز 255 حرفًا.',
    ];



    public function __construct()
    {
        foreach (AcademicDegree::cases() as $degree) {
            $key = $degree->name;
            $this->{$key}=Setting::getValue($key,0);
            $this->rules[$key] = 'required|integer|min:0';

            $this->messages["{$key}.required"] = 'راتب ' . $degree->getValue() . ' مطلوب.';
            $this->messages["{$key}.integer"] = 'راتب ' . $degree->getValue() . ' يجب أن يكون عدداً صحيحاً.';
            $this->messages["{$key}.min"] = 'راتب ' . $degree->getValue() . ' يجب ألا يكون أقل من 0.';
        }
    }


    public function submit()
    {
        $this->resetErrorBag();
        $this->rules['name'] = 'required|string|max:255|unique:departments,name,' . $this->id;
        $this->validate();

        $this->updateOrCreate();
    }

    private function updateOrCreate()
    {
        $message = '';
        $status = 'danger'; // الوضع الافتراضي هو الخطأ
        $departmentId = null; // متغير لتخزين معرف القسم

        try {
            // إنشاء القسم الجديد
            $department = Department::updateOrCreate(['id' => $this->id], [
                'name' => $this->name,
                'description' => $this->description,
                'PROFESSOR' => $this->PROFESSOR,
                'ASSOCIATE_PROFESSOR' => $this->ASSOCIATE_PROFESSOR,
                'ASSISTANT_PROFESSOR' => $this->ASSISTANT_PROFESSOR,
                'LECTURER' => $this->LECTURER,
                'TEACHING_ASSISTANT' => $this->TEACHING_ASSISTANT,
            ]);

            // تحديث الرسالة والوضع
            $message = ($this->id) ? 'تم تحديث بيانات قسم (' . $department->name . ')' : 'تم إنشاء القسم بنجاح.';
            $status = 'success';
            $departmentId = $department->id; // تخزين معرف القسم
        } catch (\Illuminate\Database\QueryException $e) {
            // مشكلة في قاعدة البيانات
            $message = 'حدث خطأ أثناء إنشاء القسم. ربما توجد قيود على قاعدة البيانات.';
        } catch (\Exception $e) {
            // أي خطأ غير متوقع
            $message = 'حدث خطأ غير متوقع أثناء إنشاء القسم.';
        } finally {
            if (!$this->id) {
                $this->dispatch('departmentCreated', [
                    'id' => $departmentId,
                    'message' => $message,
                    'status' => $status,
                ]);
                // إعادة ضبط الحقول
                $this->reset();
                return;
            }

            // إرسال الرسالة مع الحالة ومعرف القسم (إذا تم إنشاؤه)
            $this->dispatch('departmentUpdated', [
                'id' => $departmentId,
                'message' => $message,
                'status' => $status,
            ]);
            // إعادة ضبط الحقول
            $this->reset();
        }
    }

    public function edit($department)
    {
        $this->resetErrorBag();
        $this->name = $department['name'] ?? '';
        $this->description = $department['description'] ?? '';
        $this->PROFESSOR = $department['PROFESSOR'] ?? '';
        $this->ASSOCIATE_PROFESSOR = $department['ASSOCIATE_PROFESSOR'] ?? '';
        $this->ASSISTANT_PROFESSOR = $department['ASSISTANT_PROFESSOR'] ?? '';
        $this->LECTURER = $department['LECTURER'] ?? '';
        $this->TEACHING_ASSISTANT = $department['TEACHING_ASSISTANT'] ?? '';

        $this->id = $department['id'];
    }

    public function render()
    {
        return view('livewire.department.department-form');
    }
}
