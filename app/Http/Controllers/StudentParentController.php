<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentParent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class StudentParentController extends Controller
{
    public function index()
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        $parent = StudentParent::with("user")->with("children")->paginate(10);
        return view("parent.index", ['parents' => $parent]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
          if (Gate::denies('is_admin')) {
            abort(403);
        }
        $students = Student::all();
        return view("parent.Create")->with("students", $students);
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
            'childeren' => ['required', 'array'],
            'phone' => ['required'],
        ]);


        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);


        $parent = StudentParent::create([
            'phone' => $validated['phone'],
            'user_id' => $user->id,
        ]);

        foreach ($validated['childeren'] as $childId) {
            $student = Student::findOrFail($childId);
            $student->update([
                'parent_id' => $parent->id,
            ]);
        }

        return redirect()->route('parents.index')->with('success', 'Parent and children registered successfully.');
    
    }


    /**
     * Display the specified resource.
     */
    public function show(StudentParent $parent)
    {   if (Gate::denies('is_admin')) {
            abort(403);
        }
        return view("parent.show", ['parent' => $parent]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(StudentParent $parent)
    {
          if (Gate::denies('is_admin')) {
            abort(403);
        }
        $students = Student::all();
        return view('parent.Edite', ['parent' => $parent, "students" => $students]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, StudentParent $parent)
    {
          if (Gate::denies('is_admin')) {
            abort(403);
        }
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email'],
            'childeren' => ['array'],
            'phone' => ['required'],
        ]);
        $parent->update([
            'phone' => $validated['phone'],
        ]);

        $parent->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],

        ]);
        foreach ($validated['childeren'] as $childId) {
            //    dd($childId);
            $student = Student::findOrFail($childId);

            $student->update([
                'parent_id' => $parent->id,
            ]);
        }
        return redirect()->route('parents.index')->with('success', 'parent and user updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(StudentParent $parent)
    {
          if (Gate::denies('is_admin')) {
            abort(403);
        }
        if ($parent->user) {
            $parent->user->delete();
        }
        foreach ($parent->children as $child) {
            $child->update([
                "parent_id" => null
            ]);

        }

        $parent->delete();
        return redirect()->route('parents.index')->with('success', 'Parent and user Deleted successfully.');
    }
}
