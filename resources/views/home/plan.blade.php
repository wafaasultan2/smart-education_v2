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
                            الخطط
                        </h2>
                    </div>
                    <div class="col-auto">
                        <a href="{{ route('plan.report') }}" class="btn btn-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-report m-0">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                                <path d="M18 14v4h4" />
                                <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                                <path
                                    d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                                <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                <path d="M8 11h4" />
                                <path d="M8 15h3" />
                            </svg>
                        </a>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-plan">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                إنشاء خطة جديدة
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-plan" aria-label="إنشاء خطة جديدة">
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
                        <h3 class="card-title">الخطط</h3>
                    </div>
                    @livewire('plan.plan-table')
                </div>
            </div>
        </div>
    </div>



    @push('modals')
        <div class="modal modal-blur fade" id="modal-plan" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">خطة جديدة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        @livewire('plan.plan-form')
                    </div>
                </div>
            </div>
        </div>
    @endpush

    @push('modals')
        <livewire:plan.plan-details />
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
                Livewire.on('planCreated', function() {
                    console.log('Plan created');
                    const modal = document.getElementById('modal-plan');
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide();
                });

              
                Livewire.on('PlanRetrieved', function(event) {
                    const alertManager = new AlertManager();
                    if (event[0].status == '500') {
                        alertManager.showAlert(event[0].message, 'danger');
                        return;
                    }
                    const modal = document.getElementById('modal-details');
                    const modalInstance = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
                    modalInstance.show();
                });

            });

            Livewire.on('planDeleted', function(event) {
                const alertManager = new AlertManager();
                alertManager.showAlert(event[0].message, event[0].status);
            });

            Livewire.on('changeActive', function(event) {
                const alertManager = new AlertManager();
                alertManager.showAlert(event[0].message, 'danger');
                document.getElementById('isActive_' + event[0].id).checked = false;
            });
        </script>
    </x-slot>
</x-app-layout>
