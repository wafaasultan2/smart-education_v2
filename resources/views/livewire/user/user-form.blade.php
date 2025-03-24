<form wire:submit.prevent="submit">

    <div class="mb-3">
        <label class="form-label required">اسم المستخدم</label>
        <input type="text" class="form-control" wire:model="name" placeholder="اسم المستخدم" required>
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">البريد الالكتروني</label>
        <input type="text" class="form-control" wire:model="email" placeholder="البريد الالكتروني" required>
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label required">الدور</label>
        <select class="form-select" wire:model="role" required>
            <option value="">اختر الدور</option>
            @foreach (App\Enums\Role::cases() as $role)
                <option value="{{ $role }}">{{ $role->value }}</option>
            @endforeach
        </select>
        @error('role')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">كلمة المرور</label>
        <input type="text" class="form-control" wire:model="password" placeholder="كلمة المرور" required>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label required">تأكيد كلمة المرور</label>
        <input type="text" class="form-control" wire:model="password_confirmation" placeholder="تأكيد كلمة المرور"
            required>
        @error('password_confirmation')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            إلغاء
        </a>
        <button type="submit" class="btn btn-primary ms-auto">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            أضافة المستخدم
        </button>
    </div>
    <div class="position-fixed w-100 h-100 top-0 loading-box" style="right: 0;" wire:loading wire:target='submit'>
        <x-loading />
    </div>
</form>
