@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Exams</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Exam</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        @php
            // dd($exams)
        @endphp
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Exams</h5>
                            @can('is_teacher')
                                <p> <a href="{{ route( 'exams.create') }}">Add Exam</a></p>
                            @endcan
                            @if (session('success'))
                                <h3 class="text-success my-2"> {{ session('success') }}</h3>
                            @endif
                            @if (session('error'))
                                <h3 class="text-danger my-2"> {{ session('error') }}</h3>
                            @endif

                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            title
                                        </th>
                                        <th>subject</th>
                                        <th data-type="date" data-format="YYYY/DD/MM">start_time</th>
                                        <th data-type="date" data-format="YYYY/DD/MM"> end_time</th>
                                        <th>duration</th>
                                        @can('is_student')
                                            <th>Start Exam</th>
                                        @endcan

                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($exams)
                                        
                                    
                                    @foreach ($exams as $exam)
                                        <tr>
                                            <td>{{ $exam->title }}</td>
                                            <td>{{ $exam->subject->name }}</td>
                                            <td>{{ $exam->start_time }}</td>
                                            <td>{{ $exam->end_time }}</td>
                                            <td>{{ $exam->duration }}</td>
                                            @can('is_student')
                                                <td>
                                                    <form action="{{ route('exams.start', $exam->id) }}"
                                                        method='get'>
                                                        @csrf
                                                        <input type="submit" class="btn btn-primary" value="start exam"></input>
                                                    </form>
                                                </td>
                                            @endcan



                                        </tr>
                                    @endforeach
                                    @endif
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
