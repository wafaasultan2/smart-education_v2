<div class="mb-3">
    <label class="form-label required">الخطط</label>
    <select class="form-select" wire:model="plan_id" required>
        @foreach ($plans as $plan)
            <option value="{{ $plan->id }}">{{ $plan->name }}</option>
        @endforeach
    </select>
    @error('plan_id')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
