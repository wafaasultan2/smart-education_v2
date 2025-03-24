<div class="row align-items-center row-gap-2">
    <div class="col-12 col-lg-2 col-md-2 col-sm-2 form-label">
        نسبة الضريبة
    </div>
    <div class="col-12 col-lg-10 col-md-10 col-sm-10">
        <div class="position-relative">
            <input type="number" min="0" max="100" class="form-control" wire:model="tax" id="tax"
                data-tax-old="{{ $tax }}" placeholder="نسبة الضريبة" required
                oninput="this.value = (this.value < 0) ? 0 : (this.value > 100) ? 100 : this.value"
                style="text-align: right; direction: rtl;">

            <span id="validation-icon-tax" style="display:none;left: 0px;
                        top: 50%;
                        transform: translateY(-50%);" wire:click='createOrUpdate'
                class="text-success position-absolute btn">✔</span>
        </div>
        @error('tax')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
