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
                            <h5 class="card-title"> Teachers</h5>

                            <!-- General Form Elements -->
                            <form method="post" action=" {{ route('parents.update', $parent->id) }}">
                                @csrf
                                @method('PUT')
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
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="name" name="name" value="{{ $parent->user->name }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email"value="{{ $parent->user->email }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">phone</label>
                                    <div class="col-sm-10">
                                        <input type="phone" name="phone"value="{{ $parent->phone }}"
                                            class="form-control">
                                    </div>
                                </div>




                                <input type="hidden" name="role" value="parent">
                                <div class="row mb-3">
                                    <label for="student" class="col-sm-2 col-form-label">student</label>
                                    <div class="col-sm-10">
                                        <select name="childeren[]"   multiple class="form-select">
                                            @foreach ($students as $student)
                                                <option value="{{  $student->id }}"
                                                    {{ $parent->children === $student ? 'selected' : '' }}>
                                                    {{ ucfirst($student->user->name) }}
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
