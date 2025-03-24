<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">
            @if ($id)
                تعديل قسم ({{ $name }})
            @else
                قسم جديد
            @endif
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
    </div>
    <div class="modal-body">
        <form wire:submit.prevent="submit">
            @if ($id)
                <input type="hidden" wire:model='id'>
            @endif
            <div class="mb-3">
                <label class="form-label">اسم القسم</label>
                <input type="text" class="form-control" wire:model="name" placeholder="اسم القسم" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">سعر الساعة</label>
                <div class="row row-gap-3">
                    @foreach (\App\Enums\AcademicDegree::cases() as $academicDegree)
                        <div class="col-lg-6 col-md-6">
                            <label class="form-label">{{ $academicDegree->getValue() }}</label>
                            <input type="text" class="form-control" wire:model="{{ $academicDegree->value }}"
                                placeholder="سعر ساعة {{ $academicDegree->getValue() }}" required>
                            @error('{{ $academicDegree->value }}')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">وصف القسم</label>
                <textarea class="form-control" wire:model="description" id="description" rows="3" maxlength="255"
                    placeholder="وصف القسم" required></textarea>
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
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5l0 14" />
                        <path d="M5 12l14 0" />
                    </svg>
                    @if ($id)
                        تعديل القسم
                    @else
                        إنشاء قسم جديد
                    @endif
                </button>
            </div>
        </form>
    </div>
</div>
