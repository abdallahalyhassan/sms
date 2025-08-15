<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\ClassModel;
use App\Models\Schedule;
use App\Models\Student;
use App\Models\Subject;
use App\Models\User;

use Illuminate\Http\Request;

class Studentcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $Students = Student::with("user")->paginate(10);
        return view('student.index', ['students' => $Students]);
    }


    public function dashboard(Request $request)
    {
        if (Gate::denies('is_student')) {
            abort(403);
        }
        $student = Auth::user()->student;

        $classe = ClassModel::with([
            'level',
            'schedules' => function ($query) {
                $query->orderBy('day_of_week')->orderBy('period')
                    ->with(['subject', 'teacher']);
            }
        ])->findOrFail($student->class_id);

        return view("student.dashboard", ['class' => $classe]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        return view('student.Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string'],
            'confirm_password' => ['required_with:password', 'same:password'],
            'role' => ['required'],
            'gender' => ['required'],
            'level' => ['required'],
            'dob' => ['required', 'date'],
        ]);
        $class = ClassModel::where("level_id", $request['level'])->latest()->first();

        if ($class->current_students >= $class->capacity) {

            return redirect()->back()->withErrors(['errors' => 'The selected class is already full.']);
        }

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);
        $student = Student::create([
            'gender' => $validated['gender'],
            'level' => $validated['level'],
            'dob' => $validated['dob'],
            'user_id' => $user->id,
            'class_id' => $class->id,
        ]);
        $class->current_students++;
        $class->save();
        $subjects = Subject::where("level_id", $validated['level'])->get();
        $student->subjects()->attach($subjects);

        return redirect()->back()->with('success', 'User and student created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $Student)
    {
        return view('student.show', ['student' => $Student]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $Student)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }

        return view('student.Edite', ['student' => $Student]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $Student)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email',],
            'gender' => ['required'],
            'level' => ['required'],
            'dob' => ['required', 'date'],
        ]);

        $Student->update([
            'level' => $validated['level'],
            'gender' => $validated['gender'],
            'dob' => $validated['dob'],
        ]);

        $Student->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        return redirect()->route('students.index')->with('success', 'Student and user updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $Student)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        if ($Student->user) {
            $Student->user->delete();
        }

        $Student->delete();
        return redirect()->route('students.index')->with('success', 'Student and user Deleted successfully.');
    }


    public function getrepotrattendance()
    {
        $students = Student::all();
        return view("report.attendancetostudent", compact("students"));
    }

    public function getrepotrgrade()
    {
        $students = Student::all();
        return view("report.gradetostudent", compact("students"));
    }

}
