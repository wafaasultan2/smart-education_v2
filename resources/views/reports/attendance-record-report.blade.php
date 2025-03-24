
<x-report-layout>
    <x-slot name="header">
        @livewire('attendance-record.header-report')
    </x-slot>

    <div class="mt-1 mb-1 text-center w-100">
        {{ $title }}
    </div>
    <!-- Page body -->
    <div class="page-body">
        <div class="container-fluid">
            <div class="card card-lg">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="">
                                @livewire('attendance-record.table-report-attendance-record', [
                                     'fromDate' => $fromDate,
                                     'toDate' => $toDate,
                                ])
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-report-layout>
