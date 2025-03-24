<div class="col-md-6 col-lg-3">
    <div class="card">
        <div class="card-body p-4 text-center">
            <span class="avatar avatar-xl mb-3 rounded"
                style="background-image: url({{ $user->profile_photo_url }})"></span>
            <h3 class="m-0 mb-1"><a href="#">{{ $user->name }}</a></h3>
            <div class="text-secondary">{{ $user->email }}</div>
            <div class="mt-3">
                <span class="badge bg-purple-lt">{{ $user->role->value }}</span>
            </div>
        </div>
        <div class="d-flex">
            <a href="#" class="card-btn" wire:click='ban'>
                <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-activity">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 12h4l3 8l4 -16l3 8h4" />
                </svg>
                @if ($user->ban)
                    موقف
                @else
                    نشط
                @endif
            </a>
        </div>
    </div>
</div>
