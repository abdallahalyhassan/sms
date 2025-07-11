@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Teachers</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">schedule</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">schedule</h5>
                            <p> <a href="{{ route('schedules.create') }}" class="btn btn-primary mb-3">Create schedule </a>
                            </p>
                        </div>
                    </div>
                    @if (session('success'))
                        <h3 class="text-success my-2"> {{ session('success') }}</h3>
                    @endif
                    @if (session('error'))
                        <h3 class="text-danger my-2"> {{ session('error') }}</h3>
                    @endif



                    @foreach ($classes as $class)
                        <div class="card">
                            <div class="col-lg-12">
                                <div class="card-header">
                                    <h3>{{ $class->level->name }} - {{ $class->name }}</h3>
                                </div>
                                <!-- Table with stripped rows -->
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Day/Period</th>
                                            @for ($i = 1; $i <= 7; $i++)
                                                <th>Period {{ $i }}</th>
                                            @endfor
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'] as $dayName)
                                            <tr>
                                                <td>{{ $dayName }}</td>
                                                @for ($period = 1; $period <= 8; $period++)
                                                    <td>
                                                        @php
                                                            $schedule = $class->schedules
                                                                ->where('day_of_week', $dayName)
                                                                ->where('period', $period)
                                                                ->first();
                                                            // dd( $schedule->teacher->user->name );
                                                        @endphp


                                                        @if ($schedule)
                                                            <strong>{{ $schedule->subject->name }}</strong>
                                                            <br>
                                                            <small>Mr: {{ $schedule->teacher->user->name }}</small>
                                                        @endif
                                                    </td>
                                                @endfor
                                            </tr>
                                        @endforeach





                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- End Table with stripped rows -->
                    @endforeach



                </div>
            </div>
        </section>

    </main>
@endsection
