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
                            <h5 class="card-title">General Form Elements</h5>

                            <!-- General Form Elements -->
                            <form method="post" action=" {{ url("students/$student->id") }}">
                                @csrf
                                @method('PUT')
                                @if (session('success'))
                                    <h3 class="text-success my-2"> {{ session('success') }}</h3>
                                @endif
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="name" name="name" value="{{ $student->user->name }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email"value="{{ $student->user->email }}"
                                            class="form-control">
                                    </div>
                                </div>


                              
                                <input type="hidden" name="role" value="student">
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">level</label>
                                    <div class="col-sm-10">
                                        <input type="number" max="6" min="1" name="level"
                                            value="{{ $student->level }}" class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Gender</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" name="gender" 
                                            aria-label="Default select example">
                                            <option value="boy" {{ $student->gender === 'boy' ? 'selected' : '' }}>Boy
                                            </option>
                                            <option value="girl" {{ $student->gender === 'girl' ? 'selected' : '' }}>Girl
                                            </option>

                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                    <div class="col-sm-10">
                                        <input type="date" name="dob" value="{{$student->dob}}"  class="form-control">
                                    </div>
                                </div>



                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Submit Button</label>
                                    <div class="col-sm-10">
                                        <button type="submit" class="btn btn-primary">Submit Form</button>
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
