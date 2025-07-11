@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Grades</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Grades</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Grades</h5>
                            <p> <a href="{{ route('grades.create', $class_id) }}">Add Grade</a></p>
                            @if (session('success'))
                                <h3 class="text-success my-2"> {{ session('success') }}</h3>
                            @endif
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>N</b>ame
                                        </th>
                                        <th>Type.</th>
                                        <th>Grade</th>
                                        <th>Max Grade</th>
                                        <th>Delete</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        @foreach ($student->grades as $grade)
                                            <tr>
                                                <td>{{ $student->user->name }}</td>
                                                <td>{{ $grade->type  }}</td>
                                                <td>{{ $grade->max_grade  }}</td>
                                                <td>{{ $grade->grade  }}</td>
                                             
                                                <td>
                                                    <form action="{{ route('grades.delete', $grade->id) }}"
                                                        method='post'>
                                                        @method('DELETE')
                                                        @csrf
                                                         <input type="hidden" name="class_id" value="{{ $class_id }}">
                                                        <input type="submit" class="btn btn-danger" value="Delete"></input>
                                                    </form>
                                                </td>

                                            </tr>
                                        @endforeach
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
