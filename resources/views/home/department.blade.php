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
                            الأقسام
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-department">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                إنشاء قسم جديد
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-department" aria-label="إنشاء قسم جديد">
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
                        <h3 class="card-title">الأقسام</h3>
                    </div>
                    @livewire('department.department-table')
                </div>
            </div>
        </div>
    </div>



    @push('modals')
        <div class="modal modal-blur fade" id="modal-department" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                @livewire('department.department-form')
            </div>
        </div>
    @endpush

    @push('modals')
        <livewire:department.department-details />
    @endpush
    <!-- Libs JS -->
    <x-slot name="scripts">
        <script>
            document.addEventListener('livewire:init', function() {

                const descriptionInput = document.querySelector('textarea#description');
                const descriptionCount = document.getElementById('description-count');
                descriptionInput.addEventListener('input', function() {
                    const currentLength = descriptionInput.value.length;
                    descriptionCount.textContent = `${currentLength}/255`;
                });

                Livewire.on('departmentCreated', function(e) {
                    hiddenModel('department', e);
                });

                Livewire.on('departmentUpdated', function(e) {
                    hiddenModel('department', e);
                });

                Livewire.on('departmentDeleted', function(event) {
                    const alertManager = new AlertManager();
                    alertManager.showAlert(event[0].message, event[0].status);//  danger succes
                });

                Livewire.on('departmentRetrieved', function(event) {
                    if (event[0].status == '500') {
                        const alertManager = new AlertManager();
                        alertManager.showAlert(event[0].message, 'danger');
                        return;
                    }
                    const modal = document.getElementById('modal-details');
                    const modalInstance = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
                    modalInstance.show();
                });

                document.getElementById('modal-department').addEventListener('hidden.bs.modal', function() {
                    this.querySelector('form').reset();
                    this.querySelector('h5.modal-title').textContent = "قسم جديد";
                    this.querySelector('form button[type="submit"]').textContent = "إنشاء قسم جديد";
                    this.querySelectorAll('.text-danger').forEach(element => element.remove());
                });
            });
        </script>
    </x-slot>
</x-app-layout>
