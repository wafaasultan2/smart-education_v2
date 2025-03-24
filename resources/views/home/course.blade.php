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
                            المواد
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-course">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                إنشاء ماده جديدة
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-courses" aria-label="إنشاء خطة جديدة">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="page-body">
            <div class="container-xl">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">الماده</h3>
                    </div>
                    @livewire('course.course-table')
                </div>
            </div>
        </div>
    </div>

    @push('modals')
        <div class="modal modal-blur fade" id="modal-course" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                @livewire('course.course-form')
            </div>
        </div>
    @endpush


    @push('modals')
        <livewire:course.course-detials />
    @endpush

    <!-- Libs JS -->
    <x-slot name="scripts">
        <script src="{{ asset('dist/libs/tom-select/dist/js/tom-select.base.min.js?1692870487') }}" defer></script>
        <script>
            document.addEventListener('livewire:init', function() {
                Livewire.on('showEnd', (e) => {
                    setTimeout(() => {
                        inintSelect().setValue(e[0]);
                        const modal = document.getElementById('modal-course');
                        const modalInstance = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(
                            modal);
                        modalInstance.show();
                    }, 100);
                })
                Livewire.on('courseRetrieved', function(event) {
                    if (event[0].status == '500') {
                        const alertManager = new AlertManager();
                        alertManager.showAlert(event[0].message, 'danger');
                        return;
                    }
                    const modal = document.getElementById('modal-details');
                    const modalInstance = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
                    modalInstance.show();
                });

                Livewire.on('courseCreated', function(e) {
                    hiddenModel('course', e);
                    console.log(e);
                    setTimeout(() => {
                        inintSelect();
                    }, 100);
                });

                Livewire.on('courseDeleted', function(event) {
                    const alertManager = new AlertManager();
                    alertManager.showAlert(event[0].message, event[0].status);//  danger succes
                });

                Livewire.on('courseUpdated', function(e) {
                    console.log(e);
                    
                    hiddenModel('course', e);
                    setTimeout(() => {
                        inintSelect();
                    }, 100);
                });

            });

            let select = null;

            document.addEventListener("DOMContentLoaded", function() {
                inintSelect();
                document.getElementById('modal-course').addEventListener('hidden.bs.modal', function() {
                    this.querySelector('form').reset();
                    this.querySelector('h5.modal-title').textContent = "مادة جديد";
                    this.querySelector('form button[type="submit"]').textContent = "إنشاء المادة جديد";
                    this.querySelectorAll('.text-danger').forEach(element => element.remove());
                    var el = document.getElementById('select-states');
                });
            });

            function inintSelect() {
                var el = document.getElementById('select-states');
                if (!el) return;
                if (el.tomselect) {
                    el.tomselect.destroy();
                }
                select = new TomSelect(el, {
                    copyClassesToDropdown: false,
                    dropdownParent: '#parent-select',
                    controlInput: '<input>',
                    render: {
                        item: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data.customProperties +
                                    '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                        option: function(data, escape) {
                            if (data.customProperties) {
                                return '<div><span class="dropdown-item-indicator">' + data.customProperties +
                                    '</span>' + escape(data.text) + '</div>';
                            }
                            return '<div>' + escape(data.text) + '</div>';
                        },
                    },
                });

                return select;
            }
        </script>

    </x-slot>
</x-app-layout>
