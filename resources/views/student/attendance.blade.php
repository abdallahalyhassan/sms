@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Attendace</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Attendance Classe {{ $student->class->name }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Attendace</h5>

                            <!-- Table with stripped rows -->

                            <table class="table datatable">
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Attendance</label>
                                    
                                </div>
                                <thead>
                                    <tr>
                                        <th><b>Name</b></th>
                                        <th>date</th>
                                        <th>class Name</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($student->attendances as $attend)
                                        <tr>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $attend->date }}</td>
                                            <td>{{ $student->class->name ?? 'N/A' }}</td>
                                            <td>
                                                @if ($attend->status == 'present')
                                                    <span class="badge bg-success">Present</span>
                                                @elseif($attend->status == 'absent')
                                                    <span class="badge bg-danger">Absent</span>
                                                @else
                                                    <span class="badge bg-secondary">Unknown</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                     @endforelse    
                                </tbody>
                            </table>


                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
