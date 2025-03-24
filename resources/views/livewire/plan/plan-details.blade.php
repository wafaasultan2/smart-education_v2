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
                <!-- Section: Title and Department Name -->
                <div class="mb-4">
                    <h3 class="title mb-2">أسم الخطة</h3>
                    <span class="ps-4 text-secondary">{{ $plan?->name ?? 'غير محدد' }}</span>
                </div>

                <!-- Section: Department Plan -->
                <hr>
                <h3 class="title mb-3">تفاصيل القسم</h2>
                    <div class="mb-4 ps-4">
                        <h4 class="title mb-2">القسم</h4>
                        <span class="ps-4 text-secondary">{{ $plan?->department?->name ?? 'غير محدد' }}</span>

                        <h4 class="title mb-2">الوصف</h4>
                        <p class="text-muted ps-4">{{ $plan?->department?->description ?? 'غير محدد' }}</p>
                    </div>

                    <h3 class="title mb-4 mt-3">أسعار الساعات</h3>
                    <div class="row g-3">
                        @foreach (\App\Enums\AcademicDegree::cases() as $degree)
                            <div class="col-lg-4 col-md-6 col-sm-12">
                                <label class="form-label">{{ $degree->getValue() }}</label>
                                <span class="text-secondary">السعر الحالي:
                                    {{ $plan?->department?->{$degree->value} ?? 'غير محدد' }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Section: Description -->
                    <hr>
                    <div>
                        <h3 class="title mb-2">الوصف</h3>
                        <p class="text-muted">{{ $plan?->description ?? 'غير محدد' }}</p>
                    </div>
            </div>
        </div>
    </div>
</div>
