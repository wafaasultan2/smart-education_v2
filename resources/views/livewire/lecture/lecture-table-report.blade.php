<div class="table-responsive">
    <table class="table card-table table-vcenter text-nowrap datatable">
        <thead class="text-start text-red" style="background-color: #71bfff; font-size: 1.2rem;">
            <tr>
                <th class="title" style="font-size: 1.2rem">اليوم</th>
                <th class="title" style="font-size: 1.2rem">الوقت</th>
                <th class="title" style="font-size: 1.2rem">المادة</th>
                <th class="title" style="font-size: 1.2rem">القاعة</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\Enums\Days::cases() as $day)
            @php
            $i = 0;
            @endphp
            @foreach ($lectures[$day->getValue()] ?? [] as $lect)
            @if ($i == 0)
            <tr>
                <td rowspan="{{ $lectures[$day->getValue()]->count() }}" class="text-center"
                    style="background-color: #f2f2f2; font-size: 1.2rem;">
                    {{ $day->getValue() }}
                </td>
                <td>
                    {{ App\Enums\TimeLecture::{$lect->time_lecture}->getValue() }}
                </td>
                <td>
                    {{ $lect->course->name }}
                </td>
                <td>
                    {{ $lect->classRoom->name }}
                </td>
            </tr>
            @php
            $i = 1;
            @endphp
            @else
            <tr>
                <td>
                    {{ App\Enums\TimeLecture::{$lect->time_lecture}->getValue() }}
                </td>
                <td>
                    {{ $lect->course->name }}
                </td>
                <td>
                    {{ $lect->classRoom->name }}
                </td>
            </tr>
            @endif
            @endforeach
            @endforeach
        </tbody>
    </table>
</div>
