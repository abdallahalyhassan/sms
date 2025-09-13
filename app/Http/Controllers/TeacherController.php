<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        $teachers = Teacher::with("user")->paginate(10);
        dd($teachers);
        return view("teacher.index", ['teachers' => $teachers]);
    }


    public function dashboard(Request $request)
    {
         if (Gate::denies('is_teacher')) {
            abort(403);
        }
        $Teacher = Auth::user()->teacher;

        $schedules = Schedule::where("teacher_id", $Teacher->id)->get();
        // dd($Schedule);
        return view("teacher.dashboard", ['schedules' => $schedules]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        return view("teacher.Create");
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
            'subject' => ['required'],
            'phone' => ['required'],
        ]);


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);
        $teacher = Teacher::create([

            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            // 'user_id' => 2,
            'user_id' => $user->id,
        ]);
        return redirect()->back()->with('success', 'User and Teacher created successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        return view("teacher.show", ['teacher' => $teacher]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        return view('teacher.Edite', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email'],
            'subject' => ['required'],
            'phone' => ['required'],
        ]);
        $teacher->update([
            'subject' => $validated['subject'],
            'phone' => $validated['phone'],
        ]);

        $teacher->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);
        return redirect()->route('teachers.index')->with('success', 'teachers and user updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        
        if ($teacher->user) {
            $teacher->user->delete();
        }

        $teacher->delete();
        return redirect()->route('teachers.index')->with('success', 'Teacher and user Deleted successfully.');
    }




    public function getclasses()
    {
        $teacher = Auth::user()->teacher;
        $subjects=$teacher->subjects;
       $levelIds = $subjects->pluck('level_id')->unique();
        $classes=ClassModel::whereIn("level_id",$levelIds)->get();
        // dd($classes);
        return (view("teacher.classes"))->with('classes',$classes);
    }

}
