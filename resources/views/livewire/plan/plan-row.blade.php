<tr>
    <td>{{ $plan->id }}</td>
    <td>{{ $plan->name }}</td>
    <td>{{ $plan->department->name }}</td>
    <td>{{ $plan->description }}</td>
    <td>
        <div class="mb-3">
            <label class="form-check form-switch">
                <input class="form-check-input" wire:model="is_active" id="isActive_{{$plan->id}}" wire:change='onCahngeState' type="checkbox"
                    {{ $plan->is_active ? 'checked' : '' }}>
            </label>
        </div>
    </td>

    <td>
        <svg xmlns="http://www.w3.org/2000/svg"  onclick="showDetails({{ $plan->id }}, 'showPlan')" width="24"
            height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
            stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline icon-tabler-eye cursor-pointer">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
            <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
        </svg>

        <svg xmlns="http://www.w3.org/2000/svg"
            onclick="customConfirm({{ $plan->id }}, '{{ $plan->name }}', 'planDelete')"
            data-bs-toggle="modal" data-bs-target="#modal-delete" width="24" height="24" viewBox="0 0 24 24"
            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="icon icon-tabler icons-tabler-outline cursor-pointer text-red icon-tabler-trash ms-4">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 7l16 0" />
            <path d="M10 11l0 6" />
            <path d="M14 11l0 6" />
            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
        </svg>
    </td>
</tr>
