@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Classees</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"> Classees</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Classees</h5>
                            <!-- Table with stripped rows -->

                            <table class="table datatable">
                                
                                <thead>
                                    <tr>
                                        <th><b>class Name</b></th>
                                        <th>max student</th>
                                        <th>current student</th>
                                        <th>Attendance</th>
                                        <th>Grade</th>
                                        <th>Exams</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classes as $class)
                                        <tr>
                                            <td>
                                                {{ $class->name }}
                                            </td>
                                            <td>

                                                {{ $class->capacity }}
                                            </td>
                                            <td>

                                                {{ $class->current_students }}
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.attendance', $class->id) }}"
                                                    class="btn btn-info">Add Attendace</a>
                                            </td>
                                             <td>
                                              
                                                <a href="{{ route('grades.index', $class->id) }}"
                                                    class="btn btn-info">Grades</a>
                                            </td>
                                            <td>
                                              
                                                <a href="{{ route('exams.index',  $class->id) }}"
                                                    class="btn btn-info">Exams</a>
                                            </td>

                                        </tr>
                                    @endforeach
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
