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
                            حوافظ الحضور
                        </h2>
                    </div>
                    <div class="col-auto" data-bs-toggle="modal" data-bs-target="#modal-report">
                        <a class="btn btn-primary">
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
                                data-bs-target="#modal-attendee">
                                <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M12 5l0 14" />
                                    <path d="M5 12l14 0" />
                                </svg>
                                إنشاء حافظة جديدة
                            </a>
                            <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                                data-bs-target="#modal-attendee" aria-label="إنشاء حافظة جديدة">
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
                        <h3 class="card-title">الحوافظ</h3>
                    </div>
                    @livewire('attendance-record.attendance-record-table')
                </div>
            </div>
        </div>
    </div>



    @push('modals')
    <div class="modal modal-blur fade" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            @livewire('attendance-record.report-form', key('report-form-'))
        </div>
    </div>
    @endpush

    @push('modals')
    <div class="modal modal-blur fade" id="modal-attendee" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            @livewire('attendance-record.attendance-record-form')
        </div>
    </div>
    @endpush


    <!-- Libs JS -->
    <x-slot name="scripts">
        <script src="{{ asset('dist/libs/tom-select/dist/js/tom-select.base.min.js?1692870487') }}" defer></script>
        <script src="{{ asset('dist/libs/litepicker/dist/litepicker.js?1692870487') }}" defer></script>
        <script>
            let fromDate = '';
            let toDate = '';
            // الحصول على العنصر الأب
            const parentElement = document.getElementById('parent-select');

            // إيقاف تفاعل Livewire مع العنصر
            function disableLivewire() {
                parentElement.setAttribute('wire:ignore.self', 'true');
                console.log('تم إيقاف تفاعل Livewire مع العنصر.');
            }

            // إعادة تفعيل تفاعل Livewire مع العنصر
            function enableLivewire() {
                parentElement.removeAttribute('wire:ignore.self');
                console.log('تم إعادة تفعيل تفاعل Livewire مع العنصر.');
            }

            document.addEventListener('DOMContentLoaded', function() {
                const textarea = document.getElementById('report-description');
                const charCount = document.getElementById('char-count');

                textarea.addEventListener('input', function() {
                    const remainingChars = 255 - textarea.value.length;
                    charCount.textContent = `${remainingChars} حرفًا متبقية`;
                });
            });

            function submitEvent(e) {
                e.preventDefault();
                const textarea = document.getElementById('report-description');
                let title = textarea.value;
                Livewire.dispatch('submitEvent', {
                    "fromDate": fromDate,
                    "toDate": toDate,
                    "title": title,
                });
                const modal = document.getElementById('modal-report');
                const modalInstance = bootstrap.Modal.getInstance(modal);
                modalInstance.hide();
            }

            document.addEventListener('livewire:init', function() {
                Livewire.on('toggleAttended', function(event) {
                    var checkbox = document.getElementById('checkbox-' + event[0].id);
                    var isAttended = event[0].is_attended;
                    checkbox.checked = isAttended;
                });

                Livewire.on('attendanceRecordCreated', function(event) {
                    const modal = document.getElementById('modal-attendee');
                    const modalInstance = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
                    modalInstance.hide();
                    initSelect();
                });

                Livewire.on('errorEvent', function(event) {
                    const alertManager = new AlertManager();
                    alertManager.showAlert(event[0].message, 'danger');
                    const modal = document.getElementById('modal-attendee');
                    const modalInstance = bootstrap.Modal.getInstance(modal) || new bootstrap.Modal(modal);
                    modalInstance.hide();
                    initSelect();
                });

                window.Litepicker && (new Litepicker({
                    element: document.getElementById('datepicker-icon-prepend'),
                    rtl: true, // تفعيل الاتجاه من اليمين إلى اليسار
                    format: 'YYYY-MM-DD', // تنسيق التاريخ ليكون متوافقًا مع المستخدمين العرب
                    lang: 'ar', // تحديد اللغة كـ "العربية"
                    locale: {
                        name: 'ar', // تأكيد استخدام العربية
                        months: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس',
                            'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
                        ],
                        monthsShort: ['ينا', 'فبر', 'مار', 'أبر', 'ماي', 'يون', 'يول', 'أغس', 'سبت', 'أكت',
                            'نوف', 'ديس'
                        ],
                        weekdays: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
                        weekdaysShort: ['أحد', 'إثن', 'ثلا', 'أرب', 'خمي', 'جمع', 'سبت'],
                        firstDay: 6 // ضبط بداية الأسبوع على السبت
                    },
                    buttonText: {
                        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg> التالي`,
                        previousMonth: `السابق <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                    }
                })).on('selected', (date) => {
                    let selectedDate = date.format('YYYY-MM-DD');
                    Livewire.dispatch('dateGetAttends', {
                        "date": selectedDate
                    });
                    console.log(selectedDate);
                });

                window.Litepicker && (new Litepicker({
                    element: document.getElementById('datepicker-icon-from'),
                    rtl: true, // تفعيل الاتجاه من اليمين إلى اليسار
                    format: 'YYYY-MM-DD', // تنسيق التاريخ ليكون متوافقًا مع المستخدمين العرب
                    lang: 'ar', // تحديد اللغة كـ "العربية"
                    locale: {
                        name: 'ar', // تأكيد استخدام العربية
                        months: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس',
                            'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
                        ],
                        monthsShort: ['ينا', 'فبر', 'مار', 'أبر', 'ماي', 'يون', 'يول', 'أغس', 'سبت', 'أكت',
                            'نوف', 'ديس'
                        ],
                        weekdays: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
                        weekdaysShort: ['أحد', 'إثن', 'ثلا', 'أرب', 'خمي', 'جمع', 'سبت'],
                        firstDay: 6 // ضبط بداية الأسبوع على السبت
                    },
                    buttonText: {
                        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg> التالي`,
                        previousMonth: `السابق <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                    }
                })).on('selected', (date) => {
                    fromDate = date.format('YYYY-MM-DD');
                });

                window.Litepicker && (new Litepicker({
                    element: document.getElementById('datepicker-icon-to'),
                    rtl: true, // تفعيل الاتجاه من اليمين إلى اليسار
                    format: 'YYYY-MM-DD', // تنسيق التاريخ ليكون متوافقًا مع المستخدمين العرب
                    lang: 'ar', // تحديد اللغة كـ "العربية"
                    locale: {
                        name: 'ar', // تأكيد استخدام العربية
                        months: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس',
                            'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'
                        ],
                        monthsShort: ['ينا', 'فبر', 'مار', 'أبر', 'ماي', 'يون', 'يول', 'أغس', 'سبت', 'أكت',
                            'نوف', 'ديس'
                        ],
                        weekdays: ['الأحد', 'الإثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'],
                        weekdaysShort: ['أحد', 'إثن', 'ثلا', 'أرب', 'خمي', 'جمع', 'سبت'],
                        firstDay: 6 // ضبط بداية الأسبوع على السبت
                    },
                    buttonText: {
                        nextMonth: `<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 6l6 6l-6 6" /></svg> التالي`,
                        previousMonth: `السابق <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>`,
                    }
                })).on('selected', (date) => {
                    toDate = date.format('YYYY-MM-DD');
                });

                Livewire.on('inintSelect', (e) => {
                    setTimeout(() => {
                        let select = initSelect('select-states', e[0]);
                    }, 100);
                })
                initSelect();
            });

            function initSelect(elementId = 'select-states', defaultValue = null) {
                var el = document.getElementById(elementId);
                if (!el) return;

                if (el.tomselect) {
                    el.tomselect.destroy();
                }

                var select = new TomSelect(el, {
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

                // تعيين القيمة الافتراضية دون تفعيل حدث change
                if (defaultValue !== null) {
                    select.disable(); // تعطيل الـ select مؤقتًا
                    select.setValue(defaultValue, false); // تعيين القيمة الافتراضية دون تفعيل الحدث
                    select.enable(); // إعادة تفعيل الـ select
                }
                select.on('change', function() {
                    Livewire.dispatch('toggleTeacher', [select.getValue()]);
                });

                return select;
            }
        </script>
    </x-slot>
</x-app-layout>
