<div class="card d-flex justify-content-center align-items-center col-12 p-2" style="height:250px; width:200px;">
    <div class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal">
        <img src="{{ asset(Storage::url($logo_path ?? 'static/logo.svg')) }}" class="navbar-brand-image w-96 h-auto" width="150" height="150" alt="logo">
    </div>
    <input type="file" wire:model="logo" id="logoInput" class="form-control m-2 d-none" accept="image/*">
    @error('logo') <span class="text-danger" style="font-size: 10px">{{ $message }}</span> @enderror
    <button class="btn btn-primary row m-2" onclick="document.getElementById('logoInput').click()">
        <div class="col-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="icon icon-tabler icons-tabler-outline icon-tabler-replace">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M3 3m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                <path d="M15 15m0 1a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v4a1 1 0 0 1 -1 1h-4a1 1 0 0 1 -1 -1z" />
                <path d="M21 11v-3a2 2 0 0 0 -2 -2h-6l3 3m0 -6l-3 3" />
                <path d="M3 13v3a2 2 0 0 0 2 2h6l-3 -3m0 6l3 -3" />
            </svg>
        </div>
        <div class="col-10">
            تغيير الشعار
        </div>
    </button>
</div>
