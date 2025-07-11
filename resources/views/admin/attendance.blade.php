@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Attendace</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Attendance Classe {{ $students[0]->class->name }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Attendace</h5>
                             
                            @if ($errors->any())
                                <div class="alert alert-danger p-1">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>
                                                {{ $error }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @if (session('success'))
                                <h3 class="text-success my-2"> {{ session('success') }}</h3>
                            @endif
                            <!-- Table with stripped rows -->
                            <form action="{{ route('admin.addAttendance') }}" method="POST">
                                @csrf
                                <input type="hidden" name="class_id" value="{{ $students[0]->class_id }}">

                                <table class="table datatable">
                                    <div class="row mb-3">
                                        <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                        <div class="col-sm-10">
                                            <input type="date" name="date" class="form-control">
                                        </div>
                                    </div>
                                    <thead>
                                        <tr>
                                            <th><b>Name</b></th>
                                            <th>Class</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <td>
                                                    <input type="hidden" name="students[]" value="{{ $student->id }}">
                                                    {{ $student->user->name }}
                                                </td>
                                                <td>
                                                    <input type="hidden" name="class_id" value="{{ $student->class_id }}">
                                                    {{ $student->class->name ?? 'N/A' }}
                                                </td>
                                                <td>
                                                    <select name="status[]" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="present">Present</option>
                                                        <option value="absent">Absent</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-primary mt-3">Save Attendance</button>
                            </form>

                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
