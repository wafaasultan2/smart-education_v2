<form id='customize-form'  onsubmit="submitEvent(event)">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">تخصيص التقرير</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
        </div>
        <div class="modal-body">
            من:
            <div class="input-icon ms-auto mt-2">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                        <path d="M16 3v4" />
                        <path d="M8 3v4" />
                        <path d="M4 11h16" />
                        <path d="M11 15h1" />
                        <path d="M12 15v3" />
                    </svg>
                </span>
                <input class="form-control"  wire:model='formDate'
                    placeholder="حدد التاريخ" id="datepicker-icon-from" style="height: 23.5px; font-size: 0.875rem;"
                    dir="rtl" />
            </div>
            @error('fromDate')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br />
            الى:
            <div class="input-icon ms-auto mt-2">
                <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" />
                        <path d="M16 3v4" />
                        <path d="M8 3v4" />
                        <path d="M4 11h16" />
                        <path d="M11 15h1" />
                        <path d="M12 15v3" />
                    </svg>
                </span>
                <input class="form-control" wire:model='toDate'
                    placeholder="حدد التاريخ" id="datepicker-icon-to" style="height: 23.5px; font-size: 0.875rem;"
                    dir="rtl" />
            </div>
            @error('toDate')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <br />
            {{-- textarea 255 char --}}
            <div class="mt-3">
                <label for="report-description">وصف التقرير (حد أقصى 255 حرفًا):</label>
                <textarea class="form-control" id="report-description" rows="4" wire:model='title' maxlength="255"
                    placeholder="أدخل وصفًا للتقرير"></textarea>
                <small id="char-count" class="form-text text-muted">255 حرفًا متبقية</small>
            </div>
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            {{-- end textarea --}}

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إغلاق</button>
            <button type="b" class="btn btn-primary">أنشاء التقرير</button>
        </div>
    </div>
</form>
