<div class="modal modal-blur fade" id="modal-details" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Header Section -->
            <div class="modal-header">
                <h5 class="modal-title">تفاصيل</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body Section -->
            <div class="modal-body">
                <h2 class="text-center text-red-500" id="error-details"></h2>
                <!-- Section: Title and course Name -->
                <div class="mb-4">
                    <h3 class="title mb-2">أسم المادة</h3>
                    <span class="ps-4 text-secondary">{{ $course?->name ?? 'غير محدد' }}</span>
                </div>
                <div class="mb-4">
                    <h3 class="title mb-2">المستوى</h3>
                    <span class="ps-4 text-secondary">{{ ($course)?\App\Enums\Levels::{$course?->level}->getValue() : 'غير محدد' }}</span>
                </div>

                <div class="mb-4">
                    <h3 class="title mb-2">الترم</h3>
                    <span class="ps-4 text-secondary">{{ ($course)?\App\Enums\Terms::{$course?->term}->getValue() : 'غير محدد' }}</span>
                </div>

                <div class="mb-4">
                    <h3 class="title mb-2">نوع المادة</h3>
                    <span class="ps-4 text-secondary">{{ ($course)?\App\Enums\CourseType::{$course?->type}->getValue() : 'غير محدد' }}</span>
                </div>

                <!-- Section: course Plan -->
                <hr>
                <h3 class="title mb-3">تفاصيل الخطط </h2>
                    <div class="mb-4 ps-4">
                        @forelse (($course?->plans ?? []) as $plan)
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <h4 class="title d-inline">أسم الخطة: </h4>
                                    <span class="text-secondary ms-2">{{ $plan->name ?? 'غير محدد' }}</span>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <h4 class="title d-inline mt-1">تنتمي الى القسم:</h4>
                                    <span class="text-secondary ms-2">{{ $plan->department->name ?? 'غير محدد' }}</span>
                                </div>
                            </div>
                            <hr>
                        @empty
                            <h4 class="title m-4">غير محدد</h4>
                        @endforelse
                    </div>
            </div>
        </div>
    </div>
</div>
