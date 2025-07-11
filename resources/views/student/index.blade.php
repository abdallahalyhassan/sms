@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All students</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Student</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Students</h5>
                            <p> <a href="{{ route('students.create') }}">Add Student</a></p>
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
                                            <b>N</b>ame
                                        </th>
                                        <th>level.</th>
                                        <th>gender</th>
                                        <th data-type="date" data-format="YYYY/DD/MM"> Date of birth</th>
                                        <th>edite</th>
                                        <th>show</th>
                                        <th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->user->name }}</td>
                                            <td>{{ $student->level }}</td>
                                            <td>{{ $student->gender }}</td>
                                            <td>{{ $student->dob }}</td>
                                            <td>
                                                <a href="{{route('students.edit', $student->id) }}"
                                                    class="btn btn-info">edit</a>
                                            </td>
                                            <td>
                                                <a href="{{route('students.show', $student->id) }}"
                                                    class="btn btn-info">Show</a>
                                            </td>
                                            <td>
                                                <form action="{{route('students.destroy', $student->id) }}" method='post'>
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="submit" class="btn btn-danger" value="Delete"></input>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

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
