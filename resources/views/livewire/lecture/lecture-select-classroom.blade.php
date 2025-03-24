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