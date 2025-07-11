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
                            <h5 class="card-title">Grade</h5>

                            <!-- General Form Elements -->
                            <form method="get" action="{{ route('pdf.gradeforclass') }}">
                                @csrf
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    @endif @if ($errors->any())
                                        <h3 class="text-danger my-2"> {{ session('error') }}</h3>
                                    @endif

                                    <div class="row mb-3">
                                        <select name="class_id" id="class_id" class="form-select"
                                            aria-label="Default select example">
                                            <option selected>Open this select Level</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
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
