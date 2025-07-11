@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Form Elements</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Asmins</li>
                    <li class="breadcrumb-item active">Edite admin</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"> Admin</h5>

                            <!-- General Form Elements -->
                            <form method="post" action=" {{ route('admins.update', $admin->id) }}">
                                @csrf
                                @method('PUT')
                                @if (session('success'))
                                    <h3 class="text-success my-2"> {{ session('success') }}</h3>
                                @endif
                                <div class="row mb-3">
                                    <label for="inputText" class="col-sm-2 col-form-label">Name</label>
                                    <div class="col-sm-10">
                                        <input type="name" name="name" value="{{ $admin->name }}"
                                            class="form-control">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input type="email" name="email"value="{{ $admin->email }}"
                                            class="form-control">
                                    </div>
                                </div>



                                <input type="hidden" name="role" value="admin">

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
