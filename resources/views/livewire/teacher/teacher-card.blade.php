<div class="col-md-6 col-lg-3">
    <div class="card">
        <div class="card-body p-4 text-center">
            <span class="avatar avatar-xl mb-3 rounded"
                style="background-image: url({{ asset('storage/'.$teacher->image) }})"></span>
            <h3 class="m-0 mb-1"><a href="#">{{ $teacher->name }}</a></h3>
            <div class="text-secondary">{{ $teacher->phone }}</div>
            <div class="mt-3">
                <span class="badge bg-purple-lt">{{ \App\Enums\AcademicDegree::{$teacher->academic_degree}->getValue()
                    }}</span>
            </div>
        </div>
        <div class="d-flex">
            <a href="#" class="card-btn" wire:click='toggleStatus'>
                <!-- Download SVG icon from http://tabler-icons.io/i/mail -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-activity">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M3 12h4l3 8l4 -16l3 8h4" />
                </svg>
                @if ($teacher->status)
                ايقاف
                @else
                تفعيل
                @endif
            </a>
            <a class="card-btn" href="{{ route('teacher.report.reportTeacher',['teacher'=>$teacher]) }}" >
                <!-- Download SVG icon from http://tabler-icons.io/i/phone -->
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="icon icon-tabler icons-tabler-outline icon-tabler-report">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" />
                    <path d="M18 14v4h4" />
                    <path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" />
                    <path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
                    <path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                    <path d="M8 11h4" />
                    <path d="M8 15h3" />
                </svg>
                تقرير
            </a>
        </div>
    </div>
</div>
