<div class="mb-3 position-relative" id="parent-select">
    <label class="form-label required" for="select-states">المعلم</label>
    <select type="text" class="form-select" dir="ltr" id="select-states" wire:model="teacher_id"
        placeholder='أختر المعلم'>
        @foreach ($teachers as $teacher)
        <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
        @endforeach
    </select>
    @error('teacher_id')
    <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
