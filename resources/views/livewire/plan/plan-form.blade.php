<form wire:submit.prevent="submit">
    <div class="mb-3">
        <label class="form-label required">اسم الخطة</label>
        <input type="text" class="form-control" wire:model="name" placeholder="اسم الخطة" required>
        @error('name')
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
        <label class="form-label required">وصف الخطة</label>
        <textarea class="form-control" wire:model="description" id="description" rows="3" maxlength="255"
            placeholder="وصف الخطة" required></textarea>
        <div id="description-count" class="form-text">{{ strlen($description) }}/255</div>
        @error('description')
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
            إنشاء خطة جديدة
        </button>
    </div>
    <div class="position-fixed w-100 h-100 top-0  loading-box" style="right: 0;" wire:loading wire:target='submit'>
        <x-loading />
    </div>
</form>
