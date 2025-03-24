<form wire:submit.prevent="submit">
    <div class="mb-3">
        <label class="form-label required">اسم المحاضره</label>
        <input type="text" class="form-control" wire:model="name" placeholder="اسم المحاضره" required>
        @error('name')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label required">المجموعة</label>
        <input type="text" class="form-control" wire:model="group" placeholder="رقم المجموعة" required>
        @error('group')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">الوقت</label>
        <select class="form-select" wire:model="time_lecture" wire:change='toggleClassRoom' required>
            <option value="" selected>اختر الوقت</option>
            @foreach (App\Enums\TimeLecture::cases() as $timeLecture)
                <option value="{{ $timeLecture->value }}">{{ $timeLecture->getValue() }}</option>
            @endforeach
        </select>
        @error('time_lecture')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">نوع</label>
        <select class="form-select" wire:model="type" required>
            <option value="" selected>اختر النوع</option>
            @foreach (App\Enums\TypeLecture::cases() as $typeLecture)
                <option value="{{ $typeLecture->value }}">{{ $typeLecture->getValue() }}</option>
            @endforeach
        </select>
        @error('type')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">اليوم</label>
        <select class="form-select" wire:model="day" wire:change='toggleClassRoom' required>
            <option value="" selected>اختر اليوم</option>
            @foreach (App\Enums\Days::cases() as $day)
                <option value="{{ $day->value }}">{{ $day->getValue() }}</option>
            @endforeach
        </select>
        @error('day')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">القاعة</label>
        <select class="form-select" wire:model="classroom_id" required>
            <option value="" selected>اختر القاعة</option>
            @foreach ($classRooms as $classRoom)
                <option value="{{ $classRoom->id }}">{{ $classRoom->name }}</option>
            @endforeach
        </select>
        @error('classroom_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">الماده</label>
        <select class="form-select" wire:model="course"  wire:change='toggleDepartment' required>
            <option value="" selected>اختر الماده</option>
            @foreach ($courses as $courseX)
                <option value="{{ $courseX->id }}">{{ $courseX->name }}</option>
            @endforeach
        </select>
        @error('course')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">القسم</label>
        <select class="form-select" wire:model="department_id" required>
            <option value="" selected>اختر القسم</option>
            @foreach ($departments as $department)
                <option value="{{ $department->id }}">{{ $department->name }}</option>
            @endforeach
        </select>
        @error('department_id')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">الدفعه</label>
        <select class="form-select" wire:model="students" required>
            <option value="" selected>اختر الدفعه</option>
            @foreach ($academic_years as $academic_year)
                <option value="{{ $academic_year->id }}">{{ $academic_year->name }}</option>
            @endforeach
        </select>
        @error('academic_year')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">المعلم</label>
        <select class="form-select" wire:model="teacher" required>
            <option value="" selected>اختر المعلم</option>
            @foreach ($teachers as $teacherX)
                <option value="{{ $teacherX->id }}">{{ $teacherX->name }}</option>
            @endforeach
        </select>
        @error('teacher')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    {{-- <div class="mb-3">
        <label class="form-label required">وصف المحاضره</label>
        <textarea class="form-control" wire:model="description" id="description" rows="3" maxlength="255"
            placeholder="وصف المحاضره" required></textarea>
        <div id="description-count" class="form-text">{{ strlen($description) }}/255</div>
        @error('description')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div> --}}
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
            إنشاء محاضره جديدة
        </button>
    </div>
    <div class="position-fixed w-100 h-100 top-0  loading-box" style="right: 0;" wire:loading wire:target='submit'>
        <x-loading />
    </div>
</form>
