<!-- filepath: /a:/مشاريع تخرج/مشروع نادر/A_A_S/A_A_S/resources/views/livewire/teacher/teacher-form.blade.php -->
<form wire:submit.prevent="submit">
    <div class="mb-3">
        <label class="form-label required">الرقم الوظيفي</label>
        <input type="number" class="form-control" wire:model="num_job" placeholder="الرقم الوظيفي" required>
        @error('num_job')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">اسم المعلم</label>
        <input type="text" class="form-control" wire:model="name" placeholder="اسم المعلم" required>
        @error('name')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">الدرجة العلمية</label>
        <select class="form-select" wire:model="academic_degree" required>
            <option value="" selected>أختر الدرجة العلمية</option>
            @foreach (\App\Enums\AcademicDegree::cases() as $academicDegree)
            <option value="{{ $academicDegree->value }}">{{ $academicDegree->getValue() }}</option>
            @endforeach
        </select>
        @error('academic_degree')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">رقم الهاتف</label>
        <input type="phone" class="form-control" wire:model="phone" placeholder="رقم الهاتف" required>
        @error('phone')
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
        <label class="form-label required">العنوان</label>
        <input type="text" class="form-control" wire:model="address" placeholder="العنوان" required>
        @error('address')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label required">صورة المعلم</label>
        <input type="file" class="form-control" wire:model="image" required style="display: none;" id="imageInput">
        <div class="image-box" onclick="document.getElementById('imageInput').click()" style="border: 1px solid #ddd; padding: 10px; text-align: center; cursor: pointer;">
            @if ($isUploading)
                <span>جاري رفع الصورة.</span>
            @elseif ($uploadError)
                <span class="text-danger">فشل رفع الصورة: {{ $uploadErrorMessage }} حاول مره أخرى</span>
            @elseif ($imagePreview)
                <img src="{{ $imagePreview }}" alt="Preview" style="max-width: 250px;">
            @else
                <span>اختر صورة</span>
            @endif
        </div>
        @error('image')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
    <div class="modal-footer">
        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
            إلغاء
        </a>
        <button type="submit" class="btn btn-primary ms-auto" @if($isUploading) disabled @endif>
            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M12 5l0 14" />
                <path d="M5 12l14 0" />
            </svg>
            أضافة المعلم
        </button>
    </div>
    <div class="position-fixed w-100 h-100 top-0 loading-box"  style="right: 0;" wire:loading wire:target='submit'>
        <x-loading />
    </div>
</form>
