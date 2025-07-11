<?php




namespace App\Http\Controllers;
use App\Models\ClassModel;
use App\Models\Grade;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

use function PHPUnit\Framework\isArray;
class Gradecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($classId)
    {
          if (Gate::denies('is_or_admin_teacher')) {
            abort(403);
        }
        $students=Student::where("class_id",$classId)->with("grades")->get();
        return view("grade.index")->with(["class_id" => $classId,"students"=>$students]);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create($classId)
    {
          if (Gate::denies('is_or_admin_teacher')) {
            abort(403);
        }
        $students = Student::where("class_id", $classId)->get();
        
        return view("grade.create")->with("students", $students);
        // dd($students);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
          if (Gate::denies('is_or_admin_teacher')) {
            abort(403);
        }
        $request->validate([
            'students' => 'required|array',
            'type' => 'required|array',
            'subjects   ' => 'required|array',
            'max_grade' => 'required|array',
            'grade' => 'required|array',
            'type.*' => 'in:midterm,quiz,final',
            'max_grade.*' => 'numeric|min:1|max:100',
            'grade.*' => 'numeric|min:0|max:100',
        ]);
       

        $subjects=$request->subjects;
        $students = $request->students;
        $grade = $request->grade;
        $max_grade = $request->max_grade;
        $type = $request->type;
        foreach ($students as $index => $student) {
            Grade::create([
                "student_id" => $student,
                "subject_id" => $subjects[$index],
                "grade" => $grade[$index],
                "max_grade" => $max_grade[$index],
                "type" => $type[$index]
            ]);
        }
        return redirect()->route("grades.index",$request->class_id)->with('success', "Grade Saved successfully");

    }
    /**
     * Display the specified resource.
     */
    public function showtostudent()
    {  if (Gate::denies('is_student')) {
            abort(403);
        }
        $user=Auth::id();
        
        $student=Student::where("user_id",$user)->with(["grades","user"])->first();
        // dd($student);
        return view("grade.showtostudent",compact("student"));
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade,Request $request )
    {
          if (Gate::denies('is_or_admin_teacher')) {
            abort(403);
        }
        // dd($grade);
        $grade->delete();
        return redirect()->route("grades.index",$request->class_id)->with('success', "Grade Deleted successfully");

    }
     public function getrepotr(){
        if (Gate::denies('is_or_admin_teacher')) {
            abort(403);
        }
        $classes=ClassModel::all();
        return view("report.grade",compact("classes")); 
    }
}
