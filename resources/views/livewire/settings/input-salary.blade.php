<div class="mb-3 col-12">
    <label class="form-label">الأسعار الافتراضية للساعات</label>
    <div class="row row-gap-3">
        @foreach (\App\Enums\AcademicDegree::cases() as $academicDegree)
        <div class="col-lg-6 col-md-6">
            <label class="form-label">{{ $academicDegree->getValue() }}</label>
            <div class="position-relative">
                <input type="text" class="form-control" wire:model="listSalary.{{ $academicDegree->value }}"
                    placeholder="سعر ساعة {{ $academicDegree->getValue() }}" required>
                <span id="validation-icon" style="left: 0px; top: 50%; transform: translateY(-50%);" 
                      wire:click="createOrUpdate('{{ $academicDegree->value }}')"
                      class="text-success position-absolute d-block btn">✔</span>
            </div>
            @error('listSalary.{{ $academicDegree->value }}')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        @endforeach
    </div>
</div>
