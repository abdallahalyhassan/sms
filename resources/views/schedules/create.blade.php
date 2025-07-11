@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Elements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Forms</li>
                    <li class="breadcrumb-item active">Elements</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Create Scudular</h5>
                            <!-- General Form Elements -->
                            <form method="POST" action="{{ route('schedules.store') }}">
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
                                @if (session('success'))
                                    <h3 class="text-success my-2"> {{ session('success') }}</h3>
                                @endif
                                {{-- level --}}
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Level</label>
                                    <div class="col-sm-10">
                                        <select  name="level_id" id="level_id" class="form-select" aria-label="Default select example">
                                            <option selected>Open this select Level</option>
                                            @foreach ($levels as $level)
                                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                {{-- class --}}
                                 <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Class</label>
                                    <div class="col-sm-10">
                                        <select   name="class_id" id="class_id" class="form-select" aria-label="Default select example">
                                            <option value="">chose class</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Subject</label>
                                    <div class="col-sm-10">
                                        <select  name="subject_id" id="subject_id" class="form-select" aria-label="Default select example">
                                            <option value="">chose Subject</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Teacher</label>
                                    <div class="col-sm-10">
                                        <select  name="teacher_id" id="teacher_id" class="form-select" aria-label="Default select example">
                                            <option value="">chose Teacher</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">period</label>
                                    <div class="col-sm-10">
                                        <select   name="period" id="period" class="form-select" aria-label="Default select example">
                                            <option value="">chose period</option>
                                        </select>
                                    </div>
                                </div>

                                 <button type="submit" class="btn btn-primary mt-2">Save</button>






                            </form><!-- End General Form Elements -->

                        </div>
                    </div>

                </div>


            </div>
        </section>

    </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#level_id').on('change', function() {
            let levelID = $(this).val();
            $.get('/schedules/classes/' + levelID, function(data) {
                $('#class_id').empty().append('<option value="">اختر الفصل</option>');
                data.forEach(cls => {
                    $('#class_id').append('<option value="' + cls.id + '">' + cls.name +
                        '</option>');
                });
            });
        });

        $('#class_id').on('change', function() {
            let classID = $(this).val();
            $.get('/schedules/subjects/' + classID, function(data) {
                $('#subject_id').empty().append('<option value="">اختر المادة</option>');
                data.forEach(sub => {
                    $('#subject_id').append('<option value="' + sub.id + '">' + sub.name +
                        '</option>');
                });
            });
        });

        $('#subject_id').on('change', function() {
            let subjectID = $(this).val();
            $.get('/schedules/getteachers/' + subjectID, function(data) {
                $('#teacher_id').empty().append('<option value="">اختر المدرس</option>');
                data.forEach(teacher => {
                    $('#teacher_id').append('<option value="' + teacher.id + '">' + teacher.user
                        .name + '</option>');
                });
                
            });
        });

        $('#teacher_id').on('change', function() {
            let teacherID = $(this).val();
            let classID = $('#class_id').val();
            // console.log(classID);
            $.get('/schedules/free-periods?teacher_id=' + teacherID + '&class_id=' + classID, function(data) {
                $('#period').empty().append('<option value="">اختر الفترة المتاحة</option>');
                data.forEach(p => {
                    $('#period').append('<option value="' +[p.period ,p.day_name] + '">' + p.day_name +
                        ' - الحصة ' + p.period + '</option>');
                    
                });
            });
        });
    </script>
@endsection
