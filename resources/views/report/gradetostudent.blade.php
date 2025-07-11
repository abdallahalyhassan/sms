@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Elements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">class</li>
                    <li class="breadcrumb-item active">Grade</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Grade to student</h5>

                            <!-- General Form Elements -->
                            <form method="get" action="{{ route('pdf.gradeforstudent') }}">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="row mb-3">
                                    <select name="student_id" class="form-select" aria-label="Default select example">
                                        <option selected>Open this select student</option>
                                        @foreach ($students as $student)
                                            <option value="{{ $student->id }}">{{ $student->user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">start Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="startdate" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">end Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="enddate" class="form-control">
                                    </div>
                                </div> --}}
                                <div class="row mb-3">

                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Get report</button>
                                    </div>
                                </div>

                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>


            </div>
        </section>

    </main><!-- End #main -->
@endsection
