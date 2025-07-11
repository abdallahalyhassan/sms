<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Level;
use App\Models\Schedule;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


class ScheduleController extends Controller
{
    public function create()
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $levels = Level::with('classes')->get();
        return view('schedules.create', compact('levels'));
    }


    public function store(Request $request)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }

        $data = $request->validate([
            'teacher_id' => 'required|exists:teachers,id',
            'class_id' => 'required|exists:classes,id',
            'subject_id' => 'required|exists:subjects,id',
        ]);


        // var_dump($request['period']);
        // $period=$request['period';
        [$period, $day] = explode(',', $request['period']);
        $data[] = [
            "day_of_week" => $day,
            "period" => $period
        ];

        $busy = Schedule::where('teacher_id', $data['teacher_id'])
            ->orWhere('class_id', $data['class_id'])
            ->get(['day_of_week', 'period'])
            ->map(function ($s) {
                return $s->day_of_week . '-' . $s->period;
            })->toArray();


        if (in_array($request['period'], $busy)) {
            return back()->with(['errors' => 'هذه الفترة مشغولة بالفعل للمدرس أو الفصل']);
        }
        // dd($day);

        Schedule::create([
            'teacher_id' => $request->teacher_id,
            'class_id' => $request->class_id,
            'subject_id' => $request->subject_id,
            'day_of_week' => $day,
            'period' => $period,
        ]);

        return redirect()->route('schedules.index')
            ->with('success', 'تمت إضافة الحصة بنجاح!');
    }

    public function getClasses($levelId)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        return ClassModel::where('level_id', $levelId)->get();
    }

    public function getSubjects($classId)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $class = ClassModel::findOrFail($classId);
        return Subject::where('level', $class->level_id)->get();
    }

    public function getTeachers($subjectId)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $teachers = Teacher::whereHas('subjects', function ($q) use ($subjectId) {
            $q->where('subject_id', $subjectId);
        })->with("user")->get();
        return $teachers;

    }


    public function getFreeSlots(Request $request)
    {
        if (Gate::denies('is_admin')) {
            abort(403);
        }
        $request->validate([
            'teacher_id' => 'required|integer',
            'class_id' => 'required|integer',
        ]);

        $teacherId = $request->teacher_id;
        $classId = $request->class_id;
        $days = [1, 2, 3, 4, 5];
        $periods = range(1, 7);


        $busy = Schedule::where(function ($query) use ($teacherId, $classId) {
            $query->where('teacher_id', $teacherId)
                ->orWhere('class_id', $classId);
        })
            ->get(['day_of_week', 'period'])
            ->map(function ($s) {
                return $s->day_of_week . '-' . $s->period;
            })->toArray();

        $free = [];
        $busySlots = array_flip($busy);

        foreach ($days as $day) {
            foreach ($periods as $period) {
                $slotKey = $this->getDayName($day) . "-$period";
                if (!isset($busySlots[$slotKey])) {
                    $free[] = [
                        'day' => $day,
                        'period' => $period,
                        'day_name' => $this->getDayName($day),
                    ];
                }
            }
        }

        return $free;
    }

    private function getDayName($day)
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        $days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday'];

        return $days[$day - 1] ?? 'Unknown';
    }



    public function index()
    {
         if (Gate::denies('is_admin')) {
            abort(403);
        }
        $classes = ClassModel::with([
            'level',
            'schedules' => function ($query) {
                $query->orderBy('day_of_week')->orderBy('period')
                    ->with('subject', 'teacher');
            }
        ])->get();

        return view('schedules.index', compact('classes'));
    }
}
