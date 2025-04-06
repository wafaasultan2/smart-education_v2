<?php

namespace App\Livewire\Teacher;

use App\Models\Teacher;
use Livewire\Component;
use Livewire\WithFileUploads;

class TeacherForm extends Component
{
    use WithFileUploads;

    public $num_job;
    public $name;
    public $academic_degree;
    public $phone;
    public $email;
    public $address;
    public $image;
    public $imagePreview;
    public $isUploading = false;
    public $uploadError = false;
    public $uploadErrorMessage = '';

    // تحديث الحقول لتتناسب مع نظام الجامعة إذا لزم الأمر
    protected $rules = [
        'num_job' => 'required|integer',
        'name' => 'required|string|max:255',
        'academic_degree' => 'required|string', // قد تكون الدرجات العلمية بحاجة لتعديل لتناسب أكاديميات الجامعة
        'phone' => 'required|string|max:15',
        'email' => 'required|email|max:255',
        'address' => 'required|string|max:255',
        'image' => 'required|image|max:2048',
    ];

    protected $messages = [
        'num_job.required' => 'الرقم الوظيفي مطلوب.',
        'name.required' => 'اسم المعلم مطلوب.',
        'academic_degree.required' => 'الدرجة العلمية مطلوبة.',
        'phone.required' => 'رقم الهاتف مطلوب.',
        'email.required' => 'البريد الالكتروني مطلوب.',
        'address.required' => 'العنوان مطلوب.',
        'image.required' => 'الصورة مطلوبة.',
        'image.image' => 'يجب أن تكون الصورة ملف صورة.',
        'image.max' => 'يجب ألا تتجاوز الصورة 2 ميغابايت.',
    ];

    public function updatedImage()
    {
        $this->isUploading = true;
        $this->uploadError = false;
        $this->uploadErrorMessage = '';

        try {
            $this->validate(['image' => 'required|image|max:2048'], [
                'image.required' => 'الصورة مطلوبة.',
                'image.image' => 'يجب أن تكون الصورة ملف صورة.',
                'image.max' => 'يجب ألا تتجاوز الصورة 2 ميغابايت.',
            ]);
            $this->imagePreview = $this->image->temporaryUrl();
        } catch (\Exception $e) {
            $this->uploadError = true;
            $this->uploadErrorMessage = $e->getMessage();
            $this->imagePreview = null;
        }

        $this->isUploading = false;
    }

    public function submit()
    {
        $this->validate();

        // تخزين صورة المعلم
        $imagePath = $this->image->store('teachers', 'public');

        // إضافة المعلم الجديد
        $teacher = Teacher::create([
            'num_job' => $this->num_job,
            'name' => $this->name,
            'academic_degree' => $this->academic_degree,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'image' => $imagePath,
        ]);

        // إبلاغ الواجهة بأن المعلم تم إضافته
        $this->dispatch('teacherCreated', $teacher->id);

        // إعادة ضبط النموذج
        $this->reset();
    }

    public function render()
    {
        // استخدام "الجامعة" بدلاً من "الكلية" في العرض إذا لزم الأمر
        return view('livewire.teacher.teacher-form');
    }
}
