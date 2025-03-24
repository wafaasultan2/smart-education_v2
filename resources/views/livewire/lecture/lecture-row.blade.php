<tr>
    <td>{{ $lecture->id }}</td>
    <td>{{ $lecture->name }}</td>
    <td>{{ App\Enums\TimeLecture::{$lecture->time_lecture}->getValue() }}</td>
    <td>{{ optional($lecture->classRoom)->name }}</td>
    <td>{{ optional($lecture->department)->name }}</td>
    <td>{{ App\Enums\TypeLecture::{$lecture->type}->getValue() }}</td>
    <td>{{ App\Enums\Days::{$lecture->day}->getValue() }}</td>

</tr>
