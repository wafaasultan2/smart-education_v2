<tr>
    <td>{{ $attendanceRecord->id }}</td>
    <td>{{ $attendanceRecord->teacher->name }}</td>
    <td>{{ $attendanceRecord->department->name }}</td>
    <td>{{ $attendanceRecord->lecture->name }}</td>
    <td>{{ $attendanceRecord->lecture->classRoom->name }}</td>
    <td>{{ $attendanceRecord->lecture->course->name }}</td>
    <td>{{ \App\Enums\Days::{$attendanceRecord->lecture->day}->getValue() }}</td>
    <td>{{ \App\Enums\TimeLecture::{$attendanceRecord->lecture->time_lecture}->getValue() }}</td>
    <td>
        <input class="form-check-input m-0" type="checkbox" wire:click.prevent="toggleIsAttended"
            id="checkbox-{{ $attendanceRecord->id }}" @checked($isAttended) />
    </td>
</tr>
