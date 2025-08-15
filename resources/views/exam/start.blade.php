@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle d-flex justify-content-between align-items-center">
            <div>
                <h1>{{ $exam->name }}</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                        <li class="breadcrumb-item">Exams</li>
                        <li class="breadcrumb-item active">{{ $exam->name }}</li>
                    </ol>
                </nav>
            </div>
            <div class="timer-box bg-primary text-white px-3 py-2 rounded">
                <strong>Time Left: </strong> <span id="timer">--:--</span>
            </div>
        </div><!-- End Page Title -->

        <section class="section mt-3">
            <div class="row">
                <div class="col-lg-8">

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $exam->name }}</h5>

                            <!-- Exam Form -->
                            <form method="post" action="{{ route('exams.save') }}" id="examForm">
                                @csrf
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <input type="hidden" name="exam_id" value="{{ $exam->id }}">

                                @foreach ($exam->questions as $index => $question)
                                    <div class="card mb-4 border shadow-sm">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                Q{{ $index + 1 }}. {{ $question->question }}
                                            </h5>
                                            <div class="mt-3">
                                                @if ($question->type === 'tf')
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="answers[{{ $question->id }}]" value="1" required>
                                                        <label class="form-check-label">True</label>
                                                    </div>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio"
                                                            name="answers[{{ $question->id }}]" value="0" required>
                                                        <label class="form-check-label">False</label>
                                                    </div>
                                                @elseif($question->type === 'mcq')
                                                    @php
                                                        $options = json_decode($question->options, true);
                                                    @endphp
                                                    @foreach ($options as $optIndex => $option)
                                                        <div class="form-check mt-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="answers[{{ $question->id }}]"
                                                                value="{{ $option }}" required>
                                                            <label class="form-check-label">{{ $option }}</label>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <div class="text-end">
                                    <button type="submit" class="btn btn-primary px-4">Save</button>
                                </div>
                            </form>
                            <!-- End Exam Form -->

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </main><!-- End #main -->

    <script>
        let duration = {{ $remaining }}; // This is in seconds
        const timerElement = document.getElementById('timer');
        const form = document.getElementById('examForm');

        function updateTimer() {
            let minutes = Math.floor(duration / 60);
            let seconds = duration % 60;
            timerElement.textContent = `${minutes}:${seconds < 10 ? '0' : ''}${seconds}`;
            if (duration <= 0) {
                form.submit();
            } else {
                duration--;
                setTimeout(updateTimer, 1000);
            }
        }
        updateTimer();
    </script>
@endsection
