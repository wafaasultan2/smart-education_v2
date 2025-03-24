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
                            المعلمون
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-teacher">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                أضافة معلم جديدة
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-teacher" aria-label="أضافة معلم جديدة">
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
                @livewire('teacher.teacher-list')
            </div>
        </div>
    </div>



    @push('modals')
        <div class="modal modal-blur fade" id="modal-teacher" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">معلم جديدة</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        @livewire('teacher.teacher-form')
                    </div>
                </div>
            </div>
        </div>
    @endpush


    @push('modals')
        <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">التقارير</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        @livewire('teacher.report-form')
                    </div>
                </div>
            </div>
        </div>
    @endpush


    <!-- Libs JS -->
    <x-slot name="scripts">
        <script>
            function openModelReport(event) {
                const modal = document.getElementById('modal-report');

                // تأكد من وجود العنصر modal
                if (modal) {
                    // الحصول على الرابطين
                    const urlPay = event.currentTarget.getAttribute('data-url-pay');
                    const urlAttend = event.currentTarget.getAttribute('data-url-attend');

                    // تحديث الروابط داخل المودال
                    modal.querySelector('#report-pay').href = urlPay;
                    modal.querySelector('#report-attend').href = urlAttend;

                    // استدعاء طريقة لفتح المودال باستخدام Bootstrap 5
                    const modalInstance = new bootstrap.Modal(modal);
                    modalInstance.show();
                }
            }

            document.addEventListener('livewire:init', function() {

                Livewire.on('teacherCreated', function() {
                    const modal = document.getElementById('modal-teacher');
                    const modalInstance = bootstrap.Modal.getInstance(modal);
                    modalInstance.hide();
                });
            });
        </script>
    </x-slot>
</x-app-layout>
