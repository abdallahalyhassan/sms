@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Teachers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Classe Level {{$classe[0]->level_id}}</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Classes</h5>
                            <p> <a href="{{ route('AddClass',$level_id) }}">Add Class</a></p>
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
                                        <th>Level.</th>
                                        <th>Max capasaty.</th>
                                        <th>Current capasaty</th>
                                        <th>Attendace</th>
                                       
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classe as $class)
                                        <tr>
                                            <td>{{$class->name}}</td>
                                            <td>{{$class->level->name}}</td>
                                            <td>{{$class->capacity}}</td>
                                            <td>{{$class->current_students}}</td>
                                            <td>
                                                <a href="{{route('admin.attendance', $class->id) }}"
                                                    class="btn btn-info">Add Attendace</a>
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
