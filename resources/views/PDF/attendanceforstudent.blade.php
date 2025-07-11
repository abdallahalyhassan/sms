<h1>Attendance for student {{ $attendances[0]->student->user->name}}</h1>


<table border="1" width="100%" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Student</th>
            <th>Class</th>
            <th>Status</th>
            <th>Date</th>
        </tr>
    </thead>
    <tbody>
        @foreach($attendances as $atten)
            <tr>
                <td>{{ $atten->student->user->name ?? 'N/A' }}</td>
                <td>{{ $atten->class->name ?? '---' }}</td>
                <td>{{ $atten->status }}</td>
                <td>{{ $atten->date }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
