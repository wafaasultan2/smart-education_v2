<div class="position-relative" id="parent-select">
    <select type="text" class="form-select" wire:model='plan_id' dir="ltr" id="select-states"
        wire:change="handlePlanChange" @if ($isDisabled) disabled @endif>
        @foreach ($plans as $plan)
            <option value="{{ $plan->id }}">
                {{ $plan->name }} -
                {{ $plan->department->name }}</option>
        @endforeach
    </select>
</div>
