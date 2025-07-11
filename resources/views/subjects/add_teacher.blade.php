@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Add teacher to subject</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Subjects {{ $level }} </li>
                    <li class="breadcrumb-item active">ADD Teacher to {{ $subject->name }} {{ $level }} </li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> Subject</h5>

                            <!-- General Form Elements -->
                            <form method="post" action=" {{ route('subject.assign', [$level, $subject->id]) }}">
                                @csrf

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


                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Subject Name</label>
                                    <div class="col-sm-10">
                                        <input type="name" name="name" disabled
                                            value="{{ $subject->name . ' ' . $level }}" class="form-control">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="student" class="col-sm-2 col-form-label">Teachers</label>
                                    <div class="col-sm-10">
                                        <select name="teacher_id" class="form-select">
                                            <option value="" disabled>-- Select Teacher --</option>
                                            @foreach ($teachers as $teacher)
                                                <option value="{{ $teacher->id }}"
                                                    {{ isset($subject->teacher_id) && $subject->teacher_id == $teacher->id ? 'selected' : '' }}>
                                                    {{ ucfirst($teacher->user->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>






                                <div class="row mb-3">

                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Save </button>
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
