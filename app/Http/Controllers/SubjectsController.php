<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class SubjectsController extends Controller
{
    public function getsubjects($level)
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        $subjects = Subject::where('level_id', $level)->with("teacher")->get();
        // dd($subjects);
        return view('subjects.index', compact('subjects', 'level'));

    }
    public function addTeacher($level, Subject $subject)
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        $teachers = Teacher::where('subject', $subject->name)->get();
        return view('subjects.add_teacher', compact('level', 'subject', 'teachers'));
    }

    public function assignTeacher(Request $request, $level, Subject $subject)
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
        ]);
       
        $subject->teacher()->syncWithoutDetaching([$request->teacher_id]);
        return redirect()->route('subject.level', $level)->with('success', 'Teacher assigned successfully!');
    }
}
