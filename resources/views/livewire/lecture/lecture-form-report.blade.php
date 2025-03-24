<form id='customize-form' wire:submit.prevent="submit">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">تخصيص التقرير</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <div class="modal-body">
            <div class="mb-3">
                <label class="form-label required">المستوى</label>
                <select class="form-select" wire:model="level" required>
                    <option value="" selected>اختر المستوى</option>
                    @foreach (\App\Enums\Levels::cases() as $level)
                    <option value="{{ $level->value }}">{{ $level->getValue() }}</option>
                    @endforeach
                </select>
                @error('level')
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
            {{-- textarea 255 char --}}
            <div class="mt-3">
                <label for="report-description">وصف التقرير (حد أقصى 255 حرفًا):</label>
                <textarea class="form-control" id="report-description" rows="4" wire:model='title' maxlength="255"
                    placeholder="أدخل وصفًا للتقرير"></textarea>
                <small id="char-count" class="form-text text-muted">255 حرفًا متبقية</small>
            </div>
            @error('title')
            <span class="text-danger">{{ $message }}</span>
            @enderror
            {{-- end textarea --}}

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            <button type="b" class="btn btn-primary">أنشاء التقرير</button>
        </div>
    </div>
</form>
