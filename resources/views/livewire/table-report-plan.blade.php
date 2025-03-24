<div class="">
    @empty(!$tableReport)
        @isset ($tableReport[\App\Enums\Levels::First->value])
            <h2 class="text-center">{{ \App\Enums\Levels::First->getValue() }}</h2>
            <div class="row mb-3">
                <div class="col-6 row">
                    <div class="col-12 p-2 border border-azure bg-azure-lt">
                        <strong>{{ \App\Enums\Terms::First->getValue() }}</strong>
                    </div>
                    @foreach ($tableReport[\App\Enums\Levels::First->value][\App\Enums\Terms::First->value] as $course)
                        <div class="col-12 p-2 border">{{ $course->name ?? '_____________' }}</div>
                    @endforeach
                </div>
                <div class="col-6 row">
                    <div class="col-12 p-2 border border-azure bg-azure-lt">
                        <strong>{{ \App\Enums\Terms::Second->getValue() }}</strong>
                    </div>
                    @foreach ($tableReport[\App\Enums\Levels::First->value][\App\Enums\Terms::Second->value] as $course)
                        <div class="col-12 p-2 border">{{ $course->name ?? '_____________' }}</div>
                    @endforeach
                </div>
            </div>
        @endisset

        @isset ($tableReport[\App\Enums\Levels::Second->value])
            <h2 class="text-center">{{ \App\Enums\Levels::Second->getValue() }}</h2>
            <div class="row mb-3">
                <div class="col-6 row">
                    <div class="col-12 p-2 border border-azure bg-azure-lt">
                        <strong>{{ \App\Enums\Terms::First->getValue() }}</strong>
                    </div>
                    @foreach ($tableReport[\App\Enums\Levels::Second->value][\App\Enums\Terms::First->value] as $course)
                        <div class="col-12 p-2 border">{{ $course->name ?? '_____________' }}</div>
                    @endforeach
                </div>
                <div class="col-6 row">
                    <div class="col-12 p-2 border border-azure bg-azure-lt">
                        <strong>{{ \App\Enums\Terms::Second->getValue() }}</strong>
                    </div>
                    @foreach ($tableReport[\App\Enums\Levels::Second->value][\App\Enums\Terms::Second->value] as $course)
                        <div class="col-12 p-2 border">{{ $course->name ?? '_____________' }}</div>
                    @endforeach
                </div>
            </div>
        @endisset

        @isset($tableReport[\App\Enums\Levels::Third->value])
            <h2 class="text-center">{{ \App\Enums\Levels::Third->getValue() }}</h2>
            <div class="row mb-3">
                <div class="col-6 row">
                    <div class="col-12 p-2 border border-azure bg-azure-lt">
                        <strong>{{ \App\Enums\Terms::First->getValue() }}</strong>
                    </div>
                    @foreach ($tableReport[\App\Enums\Levels::Third->value][\App\Enums\Terms::First->value] as $course)
                        <div class="col-12 p-2 border">{{ $course->name ?? '_____________' }}</div>
                    @endforeach
                </div>
                <div class="col-6 row">
                    <div class="col-12 p-2 border border-azure bg-azure-lt">
                        <strong>{{ \App\Enums\Terms::Second->getValue() }}</strong>
                    </div>
                    @foreach ($tableReport[\App\Enums\Levels::Third->value][\App\Enums\Terms::Second->value] as $course)
                        <div class="col-12 p-2 border">{{ $course->name ?? '_____________' }}</div>
                    @endforeach
                </div>
            </div>
        @endisset

        @isset ($tableReport[\App\Enums\Levels::Fourth->value])
            <h2 class="text-center">{{ \App\Enums\Levels::Fourth->getValue() }}</h2>
            <div class="row mb-3">
                <div class="col-6 row">
                    <div class="col-12 p-2 border border-azure bg-azure-lt">
                        <strong>{{ \App\Enums\Terms::First->getValue() }}</strong>
                    </div>
                    @foreach ($tableReport[\App\Enums\Levels::Fourth->value][\App\Enums\Terms::First->value] as $course)
                        <div class="col-12 p-2 border">{{ $course->name ?? '_____________' }}</div>
                    @endforeach
                </div>
                <div class="col-6 row">
                    <div class="col-12 p-2 border border-azure bg-azure-lt">
                        <strong>{{ \App\Enums\Terms::Second->getValue() }}</strong>
                    </div>
                    @foreach ($tableReport[\App\Enums\Levels::Fourth->value][\App\Enums\Terms::Second->value] as $course)
                        <div class="col-12 p-2 border">{{ $course->name ?? '_____________' }}</div>
                    @endforeach
                </div>
            </div>
        @endisset
    @endempty
</div>
