<form id="attend-form" wire:submit.prevent="submit">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">أنشاء حافظه</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3 position-relative" id="parent-select" wire:ignore.self>
                <label class="form-label required" for="select-states">المعلم</label>
                <select type="text" class="form-select" dir="ltr" id="select-states" wire:model="teacher_id"
                    placeholder='أختر المعلم'>
                    <option value=""></option>
                    @foreach ($teachers as $teacher)
                        <option value="{{ $teacher->id }}" @selected($teacher->id == $teacher_id)>{{ $teacher->name }}
                        </option>
                    @endforeach
                </select>
                @error('teacher_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3 position-relative" id="parent-select">
                <label class="form-label required" for="select-states">القسم</label>
                <select type="text" class="form-select" dir="rtl" id="select-department" wire:change='toggleDepartment' wire:model="department_id"
                    placeholder='أختر القسم'>
                    <option value=""></option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}" @selected($department->id == $department_id)>{{ $department->name }}
                        </option>
                    @endforeach
                </select>
                @error('department_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 position-relative" id="parent-select">
                <label class="form-label required" for="select-states">المحاضره</label>
                <select type="text" class="form-select" dir="rtl" id="select-lecture" wire:model="lecture_id"
                    placeholder='أختر المحاضره'>
                    <option value=""></option>
                    @foreach ($lectures as $lecture)
                        <option value="{{ $lecture->id }}" @selected($lecture->id == $lecture_id)>{{ $lecture->course->name }}
                            - {{ $lecture->name }}
                        </option>
                    @endforeach
                </select>
                @error('lecture_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            <button type="submit" class="btn btn-primary">أنشاء الحافظة</button>
        </div>
    </div>
</form>
