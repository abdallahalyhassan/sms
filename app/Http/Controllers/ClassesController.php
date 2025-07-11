<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Illuminate\Support\Facades\Gate;

use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function getclassbylevel($id)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $classe = ClassModel::where("level_id", $id)->get();
        return view("Classes.index")->with(["classe" => $classe, "level_id" => $id]);
    }

    public function create($id)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $class = ClassModel::where("level_id", $id)->latest()->first();
        if ($class && $class->current_students <= $class->capacity) {
            return redirect()->back()->with('error', 'Class  ' . $class->name . " havent compeleted");
        }
        $count = ClassModel::where("level_id", $id)->count() + 1;
        ClassModel::create([
            'name' => "level " . $id . "/" . "class " . $count,
            "level_id" => $id
        ]);
        return redirect()->back()->with('success', 'Class created successfully');

    }
}
