<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSS files -->
    @if ($isNotDefult)
        <link href="{{ asset('dist/css/tabler.rtl.min.css?1692870487') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/tabler-flags.rtl.min.css?1692870487') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/tabler-payments.rtl.min.css?1692870487') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/tabler-vendors.rtl.min.css?1692870487') }}" rel="stylesheet" />
        <link href="{{ asset('dist/css/demo.rtl.min.css?1692870487') }}" rel="stylesheet" />
    @endif
    <link href="{{ asset('css/loading.css') }}" rel="stylesheet" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @if (!$isNotDefult)
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif
    <!-- Styles -->
    @isset($stylesheet)
        {{ $stylesheet }}
    @endisset
    <style>
        .alert {
            width: 350px;
            opacity: 0;
            transition: opacity 0.5s ease-in-out;
        }

        .alert.show {
            opacity: 1;
        }

        .box-alert {
            width: 90%;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
        }

        .box-connection-server {
            bottom: 20px;
            right: 20px;
            z-index: 1000;
        }

        @media (max-width:600px) {
            .alert {
                width: 90%;
            }
        }
    </style>
    @livewireStyles
</head>

<body class="font-sans  antialiased" dir="rtl">
    <script src="{{ asset('dist/js/demo-theme.min.js?1692870487') }}"></script>

    <div class="page {{ $classes }} position-relative">
        <div class="position-fixed box-alert d-flex align-items-center flex-column">
        </div>
        {{-- @livewire('navigation-menu') --}}
        {{ $header }}

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>


    <div class="position-fixed w-100 h-100 top-0  loading-box" id="snipper-loading" style="right: 0;display: none">
        <x-loading />
    </div>
    @stack('modals')
    <div class="modal modal-blur fade" id="modal-delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">هل انت متأكد؟</div>
                    <div id="modal-description"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto"
                        data-bs-dismiss="modal">الغاء</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" id="modal-accept">نعم</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('dist/js/tabler.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('dist/js/demo.min.js?1692870487') }}" defer></script>
    <script src="{{ asset('js/alert.js?1692870487') }}" defer></script>
    <script src="{{ asset('js/main.js?1692870487') }}" defer></script>

    @livewireScripts
    @isset($scripts)
        {{ $scripts }}
    @endisset
</body>

</html>
