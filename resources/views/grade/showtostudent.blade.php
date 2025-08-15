@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Grades</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Grades</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Grades</h5>
                          
                          
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        
                                        <th>subject Name.</th>
                                        <th>Type.</th>
                                        <th>Grade</th>
                                        <th>Max Grade</th>
                                   </tr>
                                </thead>
                                <tbody>
                                    
                                        @foreach ($student->grades as $grade) 
                                             <tr>
                                                
                                                <td>{{ $grade->subject->name }}</td>
                                                <td>{{ $grade->type  }}</td>
                                                <td>{{ $grade->grade  }}</td>
                                                <td>{{ $grade->max_grade  }}</td>
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
