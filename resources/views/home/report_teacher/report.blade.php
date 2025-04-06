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

            td,
            th {
                border-width: 2px;
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
                        <h2 class="page-title">
                            تقرير
                        </h2>
                    </div>
                    <!-- Page title actions -->
                    <div class="col-auto ms-auto d-print-none">
                        <button type="button" class="btn btn-primary" onclick="javascript:window.print();">
                            <!-- Download SVG icon from http://tabler-icons.io/i/printer -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path
                                    d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                                <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                                <path
                                    d="M7 13m0 2a2 2 0 0 1 2 -2h6a2 2 0 0 1 2 2v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2 -2z" />
                            </svg>
                            طباعة التقرير
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="card card-lg">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12 mb-4">
                                <div class="">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <!-- اسم الجامعة (يسار) -->
                                        <div style="">
                                            جامعة صنعاء<br />
                                            {{ $name }}
                                        </div>

                                        <!-- الشعار (وسط) -->
                                        <div style="">
                                            <img src="{{ asset('storage/' . $logo) }}" alt="شعار الموقع"
                                                class="navbar-brand-image" style="height: 80px; width: 80px;">
                                            </a>
                                        </div>

                                        <!-- التاريخ (يمين) -->
                                        <div style="">
                                            التاريخ {{ now()->format('Y-m-d') }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12 mt-5">
                                <div class="row ms-2">
                                    <div class="col-lg-12">
                                        الرقم الوظيفي: {{ $teacher->num_job }}
                                    </div>
                                    <div class="col-lg-12">
                                        الأسم: {{ $teacher->name }}
                                    </div>
                                    <div class="col-lg-12">
                                        الدرجة العلمية: {{
                                        App\Enums\AcademicDegree::{$teacher->academic_degree}->getValue()
                                        }}
                                    </div>
                                    <div class="col-lg-12">
                                        القسم: {{ $teacher->department->name }} <!-- عرض اسم القسم -->
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12  mt-4">
                                <div class="table-responsive">
                                    <table class="table card-table table-vcenter text-nowrap datatable">
                                        <thead>
                                            <tr>
                                                <th>رقم.</th>
                                                <th>القسم</th>
                                                <th>المادة</th>
                                                <th>المحاضرات</th>
                                                <th>الغيابات</th>
                                                <th>التعويضي</th>
                                                <th>مجموع المحاضرات</th>
                                                <th>الساعات</th>
                                                <th>سعر الساعة</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                            $total_attended=0;
                                            $total_absent=0;
                                            $total_substitute=0;
                                            $salary=0;
                                            @endphp
                                            @foreach ($attendanceRecords as $attendanceRecord)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $attendanceRecord->department_name }}</td>
                                                <td>{{ $attendanceRecord->course_name }}</td>
                                                <td>{{ $attendanceRecord->attended_count }}</td>
                                                <td>{{ $attendanceRecord->absent_count }}</td>
                                                <td>{{ $attendanceRecord->substitute_count }}</td>
                                                <td>{{ ($attendanceRecord->attended_count +
                                                    $attendanceRecord->substitute_count) }}</td>
                                                <td>{{ ($attendanceRecord->attended_count +
                                                    $attendanceRecord->substitute_count) * 2 }}</td>
                                                <td>{{ $attendanceRecord->salary_degree }}</td>
                                                @php
                                                $total_attended += $attendanceRecord->attended_count;
                                                $total_absent += $attendanceRecord->absent_count;
                                                $total_substitute += $attendanceRecord->substitute_count;
                                                $salary += (($attendanceRecord->attended_count +
                                                $attendanceRecord->substitute_count) * 2) *
                                                $attendanceRecord->salary_degree;
                                                @endphp
                                            </tr>
                                            @endforeach
                                            <tr>
                                                <td colspan="3">المجموع الكلي</td>
                                                <td>{{ $total_attended }}</td>
                                                <td>{{ $total_absent }}</td>
                                                <td>{{ $total_substitute }}</td>
                                                <td>{{ $total_attended + $total_substitute }}</td>
                                                <td>{{ ($total_attended + $total_substitute) * 2 }}</td>
                                                <td>{{ $salary }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>

                            <div class="col-lg-12 mt-4">
                                <div class="d-flex flex-row p-2 mb-1 card justify-content-between">
                                    <span>المبلغ الأجمالي</span>
                                    <span>{{ $salary }}</span>
                                </div>
                                <div class="d-flex flex-row card p-2 mb-1 justify-content-between">
                                    <span>الضريبه</span>
                                    <span>{{ $tax * $salary }}</span>
                                </div>
                                <div class="d-flex flex-row card p-2 mb-1 justify-content-between">
                                    <span>المتبقي المستحق</span>
                                    <span>{{ $salary - ($tax * $salary) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script src="{{ asset('dist/libs/tom-select/dist/js/tom-select.base.min.js?1692870487') }}" defer></script>
    </x-slot>
</x-app-layout>
