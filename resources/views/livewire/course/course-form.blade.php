<div class="modal-content">
    <div class="modal-header">
        <h5 class="modal-title">
            @if ($id)
                تعديل مادة ({{ $name }})
            @else
                ماده جديدة
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
                <label class="form-label required">اسم الماده</label>
                <input type="text" class="form-control" wire:model="name" placeholder="اسم المادة" required>
                @error('name')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
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
                <label class="form-label required">الترم</label>
                <select class="form-select" wire:model="term" required>
                    <option value="" selected>اختر الترم</option>
                    @foreach (\App\Enums\Terms::cases() as $level)
                        <option value="{{ $level->value }}">{{ $level->getValue() }}</option>
                    @endforeach
                </select>
                @error('term')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label required">نوع المادة</label>
                <select class="form-select" wire:model="type" required>
                    <option value="" selected>نوع المادة</option>
                    @foreach (\App\Enums\CourseType::cases() as $type)
                        <option value="{{ $type->value }}">{{ $type->getValue() }}</option>
                    @endforeach
                </select>
                @error('type')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 position-relative" id="parent-select">
                <label class="form-label required" for="select-states">الخطط</label>
                <select type="text" class="form-select" dir="ltr" id="select-states" wire:model="plan_ids"
                    multiple="multiple" placeholder='أختر الخطط'>
                    @foreach ($plans as $plan)
                        <option value="{{ $plan->id }}">{{ $plan->name }} -
                            {{ $plan->department->name }}</option>
                    @endforeach
                </select>
                @error('plan_ids')
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
                        تعديل المادة
                    @else
                        إنشاء المادة جديد
                    @endif
                </button>
            </div>

            <div class="position-fixed w-100 h-100 top-0 loading-box" style="right: 0;" wire:loading
                wire:target='submit'>
                <x-loading />
            </div>
        </form>
    </div>
</div>
