<div>
    <div class="table-responsive">
        <table class="table card-table table-vcenter text-nowrap datatable">
            <thead class="text-start text-red" style="background-color: #71bfff; font-size: 1.2rem;">
                <tr>
                    <th class="title" style="font-size: 1.2rem; width: 40px;">رقم.</th>
                    <th class="title" style="font-size: 1.2rem">الرقم الوظيفي</th>
                    <th class="title" style="font-size: 1.2rem">الاسم</th>
                    <th class="title" style="font-size: 1.2rem">القسم</th>
                    <th class="title" style="font-size: 1.2rem; width: 60px">الساعات</th>
                    <th class="title" style="font-size: 1.2rem">المبلغ</th>
                    <th class="title" style="font-size: 1.2rem">الضريبة</th>
                    <th class="title" style="font-size: 1.2rem">الصافي</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($attendanceRecords as $attendanceRecord)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $attendanceRecord->num_job }}</td>
                    <td>{{ $attendanceRecord->teacher_name }}</td>
                    <td>{{ $attendanceRecord->department_name }}</td>
                    <td>{{ $attendanceRecord->total_attendance * 2 }}</td>
                    <td>{{ ($attendanceRecord->total_attendance * 2) * $attendanceRecord->salary }}</td>
                    <td>{{ (($attendanceRecord->total_attendance * 2) * $attendanceRecord->salary) * $tax }}</td>
                    <td>{{ (($attendanceRecord->total_attendance * 2) *
                        $attendanceRecord->salary)-((($attendanceRecord->total_attendance * 2) *
                        $attendanceRecord->salary) * $tax) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
