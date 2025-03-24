<?php

namespace App\Livewire\User;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserForm extends Component
{
    public $email;
    public $name;
    public $password;
    public $password_confirmation;
    public $role;

    protected $rules;

    public function __construct()
    {
        $this->rules = [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:' . implode(',', Role::getRoles()), // الآن تعمل بشكل صحيح
        ];
    }

    protected $messages = [
        'email.required' => 'البريد الإلكتروني مطلوب.',
        'email.email' => 'يجب أن يكون البريد الإلكتروني صالحًا.',
        'email.unique' => 'البريد الإلكتروني موجود بالفعل.',
        'name.required' => 'الاسم مطلوب.',
        'name.string' => 'يجب أن يكون الاسم نصًا.',
        'password.required' => 'كلمة المرور مطلوبة.',
        'password.string' => 'يجب أن تكون كلمة المرور نصًا.',
        'password.min' => 'يجب أن تحتوي كلمة المرور على 8 أحرف على الأقل.',
        'password.confirmed' => 'كلمة المرور غير متطابقة.',
        'role.required' => 'الدور مطلوب.',
        'role.in' => 'الدور غير صالح.',
    ];


    public function submit()
    {
        $this->validate();

        $user = User::create([
            'email' => $this->email,
            'name' => $this->name,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);
        $this->dispatch('userCreated', $user->id);
        $this->reset();
    }

    public function render()
    {
        return view('livewire.user.user-form');
    }
}
