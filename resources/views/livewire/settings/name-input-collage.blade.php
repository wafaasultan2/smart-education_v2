<div class="row align-items-center row-gap-2">
    <div class="col-12 col-lg-2 col-md-2 col-sm-2 form-label">
        أسم الكلية
    </div>
    <div class="col-12 col-lg-10 col-md-10 col-sm-10">
        <div class="position-relative">
            <input type="text" class="form-control" wire:model="name_collage" id="name_collage"
                data-name_collage_old="{{ $name_collage }}" placeholder="اسم الكلية" required>
            <span id="validation-icon"
                style="display:none;left: 0px;
                        top: 50%;
                        transform: translateY(-50%);"
                wire:click='createOrUpdate' class="text-success position-absolute btn">✔</span>
        </div>
        @error('name_collage')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>
