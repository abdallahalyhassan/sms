<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Exam;
use App\Models\Grade;
use App\Models\Level;
use App\Models\Question;
use App\Models\Subject;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Svg\Tag\Rect;

class ExamController extends Controller
{
    public function index($class_id)
    {
        $class = ClassModel::find($class_id);
        $level = $class->level;
        $currentTime = now();

        if (Auth::user()->teacher) {
            $teacher = Auth::user()->teacher;
            $subject = $teacher->subjects()
                ->where('level_id', $level->id)
                ->first();

            $exams = Exam::where("subject_id", $subject->id)
                ->where('end_time', '>', $currentTime)
                ->get();

        } else {
            $subjects = Subject::where('level_id', $level->id)->pluck('id');
            $exams = Exam::whereIn("subject_id", $subjects)
                ->where('end_time', '>', $currentTime)
                ->get();
        }
        return view("exam.index", compact("exams"));


    }




    public function create(Subject $subject)
    {
        return view("exam.create", compact("subject"));
    }


    public function store(Request $request)
    {

        $validated = $request->validate([
            'exam_name' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date',
            'duration' => 'required|integer|min:1',
            'subject_id' => 'required|exists:subjects,id',
            'questions' => 'required|json',
        ]);
        // dd($validated );

        $exam = Exam::create([
            'title' => $request->exam_name,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'duration' => $request->duration,
            'subject_id' => $request->subject_id,
        ]);

        $questions = json_decode($request->questions, true);
        // dd($questions);
        foreach ($questions as $q) {
            $question = new Question([
                'type' => $q['type'],
                'question' => $q['question'],
                'points' => $q['points'],
                'subject_id' => $request->subject_id,
            ]);
            if ($q['type'] == "tf") {
                $question->correct_answer = $q['correctAnswer'];
            } else {
                $question->options = json_encode($q['options']);
                $question->correct_answer = $q['options'][$q['correctAnswer']];
            }
            $exam->questions()->save($question);


        }
        $subject = $request->subject_id;
        return redirect()->route('exams.create', compact("subject"))->with('success', 'Exam created successfully with all questions');

    }

    public function start($exam_id)
    {
        $exam = Exam::with('questions')->findOrFail($exam_id);
        $student = Auth::user()->student;

        $existing = DB::table('exam_student')
            ->where('student_id', $student->id)
            ->where('exam_id', $exam_id)
            ->first();

        if ($existing && $existing->submitted_at) {
            return redirect()->back()->with('error', 'You have already submitted this exam.');
        }

        if (!$existing) {
            DB::table('exam_student')->insert([
                'student_id' => $student->id,
                'exam_id' => $exam->id,
                'start_time' => now(),
            ]);

            // نعيد جلب السطر بعد الإدخال
            $existing = DB::table('exam_student')
                ->where('student_id', $student->id)
                ->where('exam_id', $exam_id)
                ->first();
        }

        $startTime = $existing->start_time;
        $duration = $exam->duration * 60;
        $elapsed = now()->diffInSeconds($startTime);
        $remaining = max($elapsed + $duration, 0);
        $remaining = (int) $remaining;

        return view('exam.start', compact('exam', 'remaining'));
    }



    public function save(Request $request)
    {
        $answers = $request->answers;
        $exam_id = $request->exam_id;
        $exam = Exam::findOrFail($exam_id);
        // if (!$answers) {
        //     return redirect()->route("student.dashboard");
        // }
        $grade = 0;
        $max_grade = 0;
        foreach ($answers as $index => $answer) {

            $question = Question::findOrFail($index);
            // dd($question);
            $max_grade += $question->points;

            if ($question->correct_answer === $answer) {
                $grade += $question->points;
            }
        }
        //  dd($max_grade);
        Grade::create([
            "student_id" => Auth::user()->student->id,
            "subject_id" => $exam->subject_id,
            "grade" => $grade,
            "max_grade" => $max_grade,
            "type" => $exam->title
        ]);
        DB::table('exam_student')
            ->where('student_id', Auth::user()->student->id)
            ->where('exam_id', $exam_id)
            ->update(['submitted_at' => now()]);


        return redirect()->route("student.dashboard");

    }






}
