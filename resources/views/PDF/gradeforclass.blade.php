<h1>Grade for Class {{ $grades[0]->student->class->name}}</h1>


<table border="1" width="100%" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Student</th>
            <th>Subject</th>
            <th>exam Type</th>
            <th>Max grade</th>
            <th>Grade</th>
        </tr>
    </thead>
    <tbody>
        @foreach($grades as $grade)
            <tr>
                <td>{{ $grade->student->user->name ?? 'N/A' }}</td>
                <td>{{ $grade->subject->name ?? '---' }}</td>
                <td>{{ $grade->type }}</td>
                <td>{{ $grade->max_grade }}</td>
                <td>{{ $grade->grade }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
