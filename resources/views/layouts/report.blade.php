<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- تحميل الـ CSS من المسار المحلي -->
    <link href="{{ public_path('dist/css/tabler.rtl.min.css') }}" rel="stylesheet" />
    <link href="{{ public_path('dist/css/tabler-flags.rtl.min.css') }}" rel="stylesheet" />
    <link href="{{ public_path('dist/css/tabler-payments.rtl.min.css') }}" rel="stylesheet" />
    <link href="{{ public_path('dist/css/tabler-vendors.rtl.min.css') }}" rel="stylesheet" />
    <link href="{{ public_path('dist/css/demo.rtl.min.css') }}" rel="stylesheet" />

    <!-- تحميل الخطوط من المسار المحلي -->
    <style>
        @font-face {
            font-family: 'Rubik';
            src: url('file://{{ public_path("fonts/Rubik-Regular.ttf") }}') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Rubik', sans-serif;
            direction: rtl;
        }

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
</head>

<body>
    <div class="page position-relative">
        {{ $header }}
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>
