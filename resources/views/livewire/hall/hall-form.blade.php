<form wire:submit.prevent="submit">
    <div class="mb-3">
        <label class="form-label required">اسم القاعة</label>
        <input type="text" class="form-control" wire:model="name" placeholder="اسم القاعة" required>
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label required">السعة</label>
        <input type="number" class="form-control" wire:model="capacity" placeholder="السعة" required>
        @error('capacity')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-check form-switch">
          <input class="form-check-input" wire:model="is_screen" type="checkbox" checked="">
          <span class="form-check-label">هل توجد شاشة</span>
        </label>
      </div>
    <div class="mb-3">
        <label class="form-label ">وصف القاعة</label>
        <textarea class="form-control" wire:model="description" id="description" rows="3" maxlength="255"
            placeholder="وصف القاعة"> </textarea>
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
            إنشاء قاعة جديدة
        </button>
    </div>
    <div class="position-fixed w-100 h-100 top-0  loading-box" style="right: 0;" wire:loading wire:target='submit'>
        <x-loading />
    </div>
</form>
