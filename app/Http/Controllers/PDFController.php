<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Gate;


class PDFController extends Controller
{
    public function attendanceforclass(Request $request)
    {
        if (Gate::denies('is_or_admin_teacher')) {
            abort(403);
        }
        $class_id = $request->class_id;
        $startdate = $request->startdate;
        $enddate = $request->enddate;

        $attendances = Attendance::with(['student.user', 'class'])->where("class_id", $class_id)
            ->where("date", ">=", $startdate)
            ->where("date", "<=", $enddate)
            ->get();
        if ($attendances->isEmpty()) {
            return back()->withErrors("there are no attendance for this class");
        }
        $data = ["attendances" => $attendances];
        $pdf = Pdf::loadView("PDF.attendanceforclass", $data);
        return $pdf->download('student-attendance.pdf');
    }
    public function attendanceforstudent(Request $request)
    {
        if (Gate::denies('is_or_admin_teacher')) {
            abort(403);
        }

        $student_id = $request->student_id;

        $attendances = Attendance::with(['student.user', 'class'])->where("student_id", $student_id)
            // ->where("date", ">=", $startdate)
            // ->where("date", "<=", $enddate)
            ->get();
        if ($attendances->isEmpty()) {
            return back()->withErrors("there are no attendance for this student");
        }
        $data = ["attendances" => $attendances];

        // dd($data);
        // return view("PDF.attendanceforclass", $data);

        $pdf = Pdf::loadView("PDF.attendanceforstudent", $data);
        return $pdf->download('student-attendance.pdf');
    }

    public function gradeforclass(Request $request)
    {
        if (Gate::denies('is_or_admin_teacher')) {
            abort(403);
        }
        $class_id = $request->class_id;
        // dd($class_id);

        $grades = Grade::with(['student.user', 'student.class'])
            ->whereHas('student', function ($query) use ($class_id) {
                $query->where('class_id', $class_id);
            })->orderBy("student_id")
            ->get();

        if ($grades->isEmpty()) {
            return back()->withErrors("there are no grade for this class");
        }
        // dd($grades);

        $data = ["grades" => $grades];
        // return view("PDF.gradeforclass", $data);

        $pdf = Pdf::loadView("PDF.gradeforclass", $data);
        return $pdf->download('student-grades.pdf');
    }
    public function gradeforstudent(Request $request)
    {
        if (Gate::denies('is_or_admin_teacher')) {
            abort(403);
        }
        $student_id = $request->student_id;


        $grades = Grade::where("student_id", $student_id)
            ->get();
        // dd($grades);
        if ($grades->isEmpty()) {
            return back()->withErrors("there are no grade for this student");
        }

        $data = ["grades" => $grades];
        // return view("PDF.gradeforclass", $data);

        $pdf = Pdf::loadView("PDF.gradeforstudent", $data);
        return $pdf->download('student-grades.pdf');
    }
}
