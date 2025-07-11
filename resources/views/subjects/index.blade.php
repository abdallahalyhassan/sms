@extends('layouts.app')

@section('content')


    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Subjects Level {{$level}}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Subjects</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Subjects Level {{$level}}</h5>
                            
                            @if (session('success'))
                                <h3 class="text-success my-2"> {{ session('success') }}</h3>
                            @endif
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>
                                            <b>N</b>ame
                                        </th>
                                        <th>level.</th>
                                        <th>Teacher</th>
                                      
                                        

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <td>{{ $subject->name }}</td>
                                            
                                            <td>{{ $subject->level }}</td>
                                            <td>
                                              
                                               
                                                @if (isset($subject->teacher[0]))
                                                <a href="{{ route("subject.addteacher", [$level,$subject]) }}"
                                                    class="btn btn-info">{{ $subject->teacher[0]->user->name }}</a>
                                                   
                                                @else
                                                <a href="{{ route("subject.addteacher", [$level,$subject]) }}"
                                                    class="btn btn-info">ADD Teacher</a>
                                                    
                                                @endif
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
