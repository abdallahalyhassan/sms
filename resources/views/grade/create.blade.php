@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Attendace</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Grade Classe {{ $students[0]->class->name }}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Grade</h5>
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
                            <form action="{{ route('grades.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="class_id" value="{{ $students[0]->class_id }}">

                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th><b>Name</b></th>
                                            <th>subject</th>
                                            <th>type of exam</th>
                                            <th>max Grade</th>
                                            <th>Grade</th>
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
                                                    <select name="subjects[]" class="form-select"
                                                        aria-label="Default select example">
                                                        @foreach ($student->subjects as $subject)
                                                            <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                                           
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <select name="type[]" class="form-select"
                                                        aria-label="Default select example">
                                                        <option value="midterm">Midterm</option>
                                                        <option value="quiz">quiz</option>
                                                        <option value="final">Final</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" name="max_grade[]" max="100">

                                                </td>
                                                <td>
                                                    <input type="number" name="grade[]" max="100">

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <button type="submit" class="btn btn-primary mt-3">Save Grade</button>
                            </form>

                            <!-- End Table with stripped rows -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main>
@endsection
