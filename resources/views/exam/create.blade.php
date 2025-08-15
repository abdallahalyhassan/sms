@extends('layouts.app')

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>All Exams</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Exam</li>
                </ol>
            </nav>
        </div>
        <div class="container" dir="rtl">
            <h1 class="my-4"> Add questions</h1>

            <form id="questions-form" action="{{ route('exams.store') }}" method="POST">
                @csrf
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
                 @if (session('success'))
                                <h3 class="text-success my-2"> {{ session('success') }}</h3>
                            @endif
                <div class="row mb-3">
                    <label for="exam_name" class="col-sm-2 col-form-label">Exam Name</label>
                    <div class="col-sm-10">
                        <input type="text" id="exam_name" name="exam_name" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="start_time" class="col-sm-2 col-form-label">Start Time</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" id="start_time" name="start_time" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="end_time" class="col-sm-2 col-form-label">End Time</label>
                    <div class="col-sm-10">
                        <input type="datetime-local" id="end_time" name="end_time" class="form-control" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="duration" class="col-sm-2 col-form-label">Duration (minutes)</label>
                    <div class="col-sm-10">
                        <input type="number" id="duration" name="duration" class="form-control" min="1"
                            placeholder="Enter duration in minutes" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <label for="subject_id" class="col-sm-2 col-form-label">Subject</label>
                    <div class="col-sm-10">
                        <input type="hidden" name="subject_id" value="{{ $subject->id }}">
                    </div>
                </div>



                <div class="card mb-4">
                    <div class="card-header">Add new question</div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="qtype">Qustion type</label>
                            <select id="qtype" class="form-control" onchange="changeQuestionType()">
                                <option value="">Qustion type</option>
                                <option value="mcq"> MCQ</option>
                                <option value="tf">True or false</option>
                            </select>
                        </div>

                        <div id="question-form-container" style="display: none;">
                            <div id="mcq-form" style="display: none;">
                                <div class="form-group">
                                    <label for="mcq-question">Qustion</label>
                                    <textarea id="mcq-question" class="form-control" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Options:</label>
                                    <div class="option mb-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" name="mcq-correct" value="1">
                                                </div>
                                            </div>
                                            <input type="text" id="mcq-option1" class="form-control"
                                                placeholder="Option one">
                                        </div>
                                    </div>
                                    <div class="option mb-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" name="mcq-correct" value="2">
                                                </div>
                                            </div>
                                            <input type="text" id="mcq-option2" class="form-control"
                                                placeholder="Option two">
                                        </div>
                                    </div>
                                    <div class="option mb-2">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">
                                                    <input type="radio" name="mcq-correct" value="3">
                                                </div>
                                            </div>
                                            <input type="text" id="mcq-option3" class="form-control"
                                                placeholder="Option three">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="tf-form" style="display: none;">
                                <div class="form-group">
                                    <label for="tf-question">Qustion</label>
                                    <textarea id="tf-question" class="form-control" rows="3"></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Corect answer</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="tf-true" name="tf-correct"
                                            value="true">
                                        <label class="form-check-label" for="tf-true">true</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" id="tf-false" name="tf-correct"
                                            value="false">
                                        <label class="form-check-label" for="tf-false">false</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputText" class="col-sm-2 col-form-label">Points</label>
                                <div class="col-sm-10">
                                    <input type="number" max="5" min="1" id="points"
                                        class="form-control">
                                </div>
                            </div>
                            <button type="button" class="btn btn-primary mt-3" onclick="addQuestion()">Add New
                                Qustion</button>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">Qustions</div>
                    <div class="card-body">
                        <div id="questions-list"></div>

                        <input type="hidden" name="questions" id="questions-data">

                        <button type="submit" class="btn btn-success mt-3">Save </button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script>
        let questions = [];

        function changeQuestionType() {
            const qtype = document.getElementById('qtype').value;
            const formContainer = document.getElementById('question-form-container');
            const mcqForm = document.getElementById('mcq-form');
            const tfForm = document.getElementById('tf-form');

            if (qtype === '') {
                formContainer.style.display = 'none';
                return;
            }

            formContainer.style.display = 'block';

            if (qtype === 'mcq') {
                mcqForm.style.display = 'block';
                tfForm.style.display = 'none';
            } else if (qtype === 'tf') {
                mcqForm.style.display = 'none';
                tfForm.style.display = 'block';
            }
        }

        function addQuestion() {
            const qtype = document.getElementById('qtype').value;
            const pointsInput = document.getElementById('points');
            let points = parseInt(pointsInput.value, 10);

            // ضمان قيمة صحيحة
            if (isNaN(points) || points < 1) points = 1;
            if (points > 5) points = 5;

            if (qtype === 'mcq') {
                const questionText = document.getElementById('mcq-question').value.trim();
                const option1 = document.getElementById('mcq-option1').value.trim();
                const option2 = document.getElementById('mcq-option2').value.trim();
                const option3 = document.getElementById('mcq-option3').value.trim();
                const correctOption = document.querySelector('input[name="mcq-correct"]:checked');

                if (!questionText || !option1 || !option2 || !option3 || !correctOption) {
                    alert('الرجاء ملء جميع حقول سؤال الـ MCQ وتحديد الإجابة الصحيحة.');
                    return;
                }

                const question = {
                    type: 'mcq',
                    question: questionText,
                    options: [option1, option2, option3],
                    correctAnswer: parseInt(correctOption.value, 10) - 1, // نحول من 1/2/3 إلى 0/1/2
                    points: points
                };

                questions.push(question);
                displayQuestions();
                resetMCQForm();

            } else if (qtype === 'tf') {
                const questionText = document.getElementById('tf-question').value.trim();
                const correctAnswer = document.querySelector('input[name="tf-correct"]:checked');

                if (!questionText || !correctAnswer) {
                    alert('الرجاء كتابة السؤال وتحديد الإجابة (صح/خطأ).');
                    return;
                }

                const question = {
                    type: 'tf',
                    question: questionText,
                    correctAnswer: (correctAnswer.value === 'true'),
                    points: points
                };

                questions.push(question);
                displayQuestions();
                resetTFForm();
            }

            // حدّث الحقل المخفي
            document.getElementById('questions-data').value = JSON.stringify(questions);

            // رجّع النقاط للـ 1 افتراضياً
            pointsInput.value = 1;
        }

        function displayQuestions() {
            const questionsList = document.getElementById('questions-list');
            questionsList.innerHTML = '';

            if (questions.length === 0) {
                questionsList.innerHTML = '<p>لم يتم إضافة أي أسئلة بعد</p>';
                return;
            }

            questions.forEach((question, index) => {
                const questionDiv = document.createElement('div');
                questionDiv.className = 'card mb-3';
                questionDiv.innerHTML = `
                <div class="card-body">
                    <h5 class="card-title">السؤال ${index + 1} <span class="badge bg-info">${question.points} درجة</span></h5>
                    <p class="card-text">${escapeHtml(question.question)}</p>
                    ${question.type === 'mcq'
                        ? renderMcqPreview(question)
                        : renderTfPreview(question)
                    }
                    <button type="button" class="btn btn-danger btn-sm mt-2" onclick="removeQuestion(${index})">حذف</button>
                </div>
            `;
                questionsList.appendChild(questionDiv);
            });
        }

        function renderMcqPreview(q) {
            return `
            <p><strong>النوع:</strong> اختيار من متعدد</p>
            <ul class="list-group">
                ${q.options.map((option, i) => `
                                        <li class="list-group-item ${i === q.correctAnswer ? 'list-group-item-success' : ''}">
                                            ${escapeHtml(option)} ${i === q.correctAnswer ? '(الإجابة الصحيحة)' : ''}
                                        </li>
                                    `).join('')}
            </ul>
        `;
        }

        function renderTfPreview(q) {
            return `
            <p><strong>النوع:</strong> صح أو خطأ</p>
            <p><strong>الإجابة الصحيحة:</strong> ${q.correctAnswer ? 'صح' : 'خطأ'}</p>
        `;
        }

        function removeQuestion(index) {
            questions.splice(index, 1);
            displayQuestions();
            document.getElementById('questions-data').value = JSON.stringify(questions);
        }

        function resetMCQForm() {
            document.getElementById('mcq-question').value = '';
            document.getElementById('mcq-option1').value = '';
            document.getElementById('mcq-option2').value = '';
            document.getElementById('mcq-option3').value = '';
            const correctOption = document.querySelector('input[name="mcq-correct"]:checked');
            if (correctOption) correctOption.checked = false;
        }

        function resetTFForm() {
            document.getElementById('tf-question').value = '';
            const correctAnswer = document.querySelector('input[name="tf-correct"]:checked');
            if (correctAnswer) correctAnswer.checked = false;
        }

        // قبل إرسال النموذج تأكد أن الحقل المخفي محدث
        document.getElementById('questions-form').addEventListener('submit', function() {
            document.getElementById('questions-data').value = JSON.stringify(questions);
        });

        // لحماية العرض (XSS) – بسيط
        function escapeHtml(str) {
            return str.replace(/[&<>'\"]/g, function(c) {
                return ({
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '\'': '&#39;',
                    '"': '&quot;'
                })[c];
            });
        }
    </script>
@endsection
