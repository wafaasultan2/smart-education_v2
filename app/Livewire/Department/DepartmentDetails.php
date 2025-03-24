<?php

namespace App\Livewire\Department;

use App\Models\Department;
use Livewire\Component;

class DepartmentDetails extends Component
{
    public Department $department;

    protected $listeners = ['showDepartment' => 'show'];

    public function show($id)
    {
        $message = '';
        $status = '500';
        try {
            $this->department = Department::findOrFail($id);
            $message = 'تم العثور على القسم بنجاح.';
            $status = '200';
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $message = 'القسم المطلوب غير موجود.';
        } catch (\Exception $e) {
            $message = 'حدث خطأ غير متوقع.';
        } finally {
            $this->dispatch('departmentRetrieved', ['message' => $message, 'status' => $status]);
        }
    }

    public function render()
    {
        return view('livewire.department.department-details');
    }
}
