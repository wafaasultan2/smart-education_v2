<div>
    <header class="navbar navbar-expand-md d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu"
                aria-controls="navbar-menu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">
                <a href=".">
                    <img src="{{ asset('static/logo.svg') }}" width="110" height="32" alt="شعار الموقع"
                        class="navbar-brand-image">
                </a>
            </h1>
            <div class="navbar-nav flex-row order-md-last">
                <div class="d-none d-md-flex">
                    <a href="?theme=dark" class="nav-link px-0 hide-theme-dark" title="تفعيل الوضع الليلي"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <!-- أيقونة الوضع الليلي -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 3c.132 0 .263 0 .393 0a7.5 7.5 0 0 0 7.92 12.446a9 9 0 1 1 -8.313 -12.454z" />
                        </svg>
                    </a>
                    <a href="?theme=light" class="nav-link px-0 hide-theme-light" title="تفعيل الوضع النهاري"
                        data-bs-toggle="tooltip" data-bs-placement="bottom">
                        <!-- أيقونة الوضع النهاري -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 12m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                            <path
                                d="M3 12h1m8 -9v1m8 8h1m-9 8v1m-6.4 -15.4l.7 .7m12.1 -.7l-.7 .7m0 11.4l.7 .7m-12.1 -.7l-.7 .7" />
                        </svg>
                    </a>
                </div>
                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                        aria-label="فتح قائمة المستخدم">
                        <span class="avatar avatar-sm"
                            style="background-image: url({{ \Illuminate\Support\Facades\Auth::user()->profile_photo_url }})"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ auth()->user()->name }}</div>
                            <div class="mt-1 small text-secondary">{{ Auth::user()->role->value }}</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="{{ route('profile.show') }}" class="dropdown-item">الملف الشخصي</a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link class="dropdown-item"
                                style="padding: var(--tblr-dropdown-item-padding-y) var(--tblr-dropdown-item-padding-x) !important"
                                href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                {{ __('تسجيل الخروج') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <header class="navbar-expand-md">
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div class="navbar">
                <div class="container-xl">
                    <ul class="navbar-nav">
                        {{-- @dd(config('navItems')) --}}
                        @foreach (config('navItems') as $navItem)
                            @if (array_search(auth()->user()->role->value, $navItem['roles']) !== false)
                                @if ($navItem['type'] === 'dropdown')
                                    @livewire('dropdown-menu', ['object' => $navItem])
                                @else
                                    @livewire('nav-item', ['object' => $navItem])
                                @endif
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </header>
</div>
