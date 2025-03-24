<x-app-layout>
    <x-slot name='stylesheet'>
        <style>
            @import url('https://rsms.me/inter/inter.css');

            :root {
                --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
            }

            body {
                font-feature-settings: "cv03", "cv04", "cv11";
            }
        </style>
    </x-slot>

    <!-- Navbar -->
    <x-slot name="header">
        @livewire('header-main')
    </x-slot>

    <div class="page-wrapper">
        <!-- Page header -->
        <div class="page-header d-print-none">
            <div class="container-xl">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <!-- Page pre-title -->
                        <div class="page-pretitle">
                            نظرة عامة
                        </div>
                        <h2 class="page-title">
                            الإعدادات
                        </h2>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body mt-7">
            <div class="container-xl">
                <div class="row gap-3 align-items-center justify-content-center">
                    <div class="col-12">
                        <livewire:settings.name-input-collage />
                    </div>
                    <div class="col-12">
                        <livewire:settings.input-tax />
                    </div>
                    <livewire:settings.swap-logo />
                    <livewire:settings.input-salary />
                    <livewire:settings.managment-year />
                </div>
            </div>
        </div>
    </div>



    @push('modals')
    @endpush


    <!-- Libs JS -->
    <x-slot name="scripts">
        <script>
            document.addEventListener('livewire:init', function() {
                let originalValue = document.getElementById('name_collage').getAttribute("data-name_collage_old");
                let originalValueTax = document.getElementById('tax').getAttribute("data-tax-old");

                document.getElementById('tax').addEventListener('input', function(e) {
                    let currentValue = e.target.value.trim();
                    if (currentValue !== originalValueTax) {
                        document.getElementById('validation-icon-tax').style.display = 'block';
                    } else {
                        document.getElementById('validation-icon-tax').style.display = 'none';
                    }
                });

                document.getElementById('name_collage').addEventListener('input', function(e) {
                    let currentValue = e.target.value.trim();
                    if (currentValue !== originalValue) {
                        document.getElementById('validation-icon').style.display = 'block';
                    } else {
                        document.getElementById('validation-icon').style.display = 'none';
                    }
                });
            });
        </script>
    </x-slot>
</x-app-layout>
