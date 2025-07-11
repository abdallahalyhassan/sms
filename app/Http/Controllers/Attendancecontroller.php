<?php

namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Auth;

use App\Models\Attendance;
use App\Models\ClassModel;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Gate;


class Attendancecontroller extends Controller
{
    public function index($id)
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        $students = Student::where("class_id", $id)->with("class")->get();
        return view("admin.attendance")->with("students", $students);
    }
   public function showtostudent()
    {
        if (Gate::denies('is_student')) {
            abort(403);
        }
        
        $user=Auth::id();
        
        $student=Student::where("user_id",$user)->with(["attendances","user"])->first();
        // dd($student);
        return view("student.attendance",compact("student"));
    }

    public function addAttendance(Request $request)
    {
        if (Gate::denies('is_or_admin_teacher')) {
            abort(403);
        }
        
        $request->validate([
            'students' => 'required|array',
            'students.*' => 'required|exists:students,id',
            'status' => 'required|array',
            'status.*' => 'required|in:present,absent',
            'date' => 'required|date|before_or_equal:today',
        ]);
        // dd(11);

       
        $students = $request->students;
        $status = $request->status;
        $class_id = $request->class_id;
        $date = $request->date;
        foreach ($students as $index => $student) {
            Attendance::create([
                "student_id" => $student,
                "class_id" => $class_id,
                "status" => $status[$index],
                "date" => $date
            ]);

        }
        return redirect()->route("admin.attendance",$class_id)->with('success', 'Attendance Saved successfully');
    }

    public function getrepotr(){
        if (Gate::denies('is_or_admin_teacher')) {
            abort(403);
        }
        $classes=ClassModel::all();
        return view("report.attendance",compact("classes")); 
    }

}
