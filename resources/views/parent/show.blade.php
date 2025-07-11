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
                            <h5 class="card-title"> Parent Info</h5>

                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="name" name="name" readonly value="{{ $parent->user->name }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email" readonly value="{{ $parent->user->email }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">phone</label>
                                    <div class="col-sm-10">
                                        <input type="phone" name="phone" readonly value="{{ $parent->phone }}"
                                            class="form-control">
                                    </div>
                                </div>




                                <input type="hidden" name="role" value="teacher">
                                <div class="row mb-3">
                                    <label for="subject" class="col-sm-2 col-form-label">Subject</label>
                                    <div class="col-sm-10">
                                        <select name="subject" readonly id="subject" class="form-select">
                                            @foreach ($parent->children as $child)
                                                <option >
                                                    {{ $child->user->name }}
                                                </option>
                                            @endforeach
                                          
                                        </select>
                                    </div>
                                </div>

                           
                        </div>
                    </div>

                </div>


            </div>
        </section>

    </main><!-- End #main -->
@endsection
