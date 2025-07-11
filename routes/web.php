<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Attendancecontroller;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\Gradecontroller;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\Studentcontroller;
use App\Http\Controllers\StudentParentController;
use App\Http\Controllers\SubjectsController;
use App\Http\Controllers\TeacherController;
use App\Models\StudentParent;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::Post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/teacher/dashboard', [TeacherController::class, 'dashboard'])->name('teacher.dashboard');
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');



});




Route::resource('students', StudentController::class)->middleware(['auth', 'verified']);

Route::resource('teachers', TeacherController::class)->middleware(['auth', 'verified']);

Route::resource('parents', StudentParentController::class)->middleware(['auth', 'verified']);

Route::resource('admins', AdminController::class)->middleware(['auth', 'verified']);



Route::middleware('auth')->group(function () {
    Route::get('/subject/{level}', [SubjectsController::class, 'getsubjects'])->name('subject.level');
    Route::get('/subject/{level}/{subject}/add-teacher', [SubjectsController::class, 'addTeacher'])->whereNumber('level')->name('subject.addteacher');
    Route::post('/subject/{level}/{subject}/assign-teacher', [SubjectsController::class, 'assignTeacher'])->name('subject.assign');

    Route::get('/getlevels', [LevelController::class, "getalllevels"])->name('getlevels');

    Route::get('/AddClass/{id}', [ClassesController::class, "create"])->name('AddClass');
    Route::get('/getclassbylevel/{id}', [ClassesController::class, "getclassbylevel"])->name('getclassesbylevel');

    Route::get('/admin/attendance/{id}', [Attendancecontroller::class, 'index'])->name('admin.attendance');
    Route::post('/admin/adddattendance', [Attendancecontroller::class, 'addattendance'])->name('admin.addAttendance');
   
    Route::get('attendance/gettostudent', [Attendancecontroller::class, "showtostudent"])->middleware(['auth', 'verified'])->name("attendance.showtostudent");

    Route::get('/getclasses', [TeacherController::class, 'getclasses'])->name('teacher.getclasses');

    Route::get('grades/index/{class}', [Gradecontroller::class, "index"])->middleware(['auth', 'verified'])->name("grades.index");
    Route::get('grades/create/{class}', [Gradecontroller::class, "create"])->middleware(['auth', 'verified'])->name("grades.create");
    Route::post('grades/store', [Gradecontroller::class, "store"])->middleware(['auth', 'verified'])->name("grades.store");
    Route::delete('grades/delete/{grade}', [Gradecontroller::class, "destroy"])->middleware(['auth', 'verified'])->name("grades.delete");
    Route::get('grades/gettostudent', [Gradecontroller::class, "showtostudent"])->middleware(['auth', 'verified'])->name("grades.showtostudent");


    Route::get('/admin/getreportattendancetostudent', [Studentcontroller::class, 'getrepotrattendance'])->name('admin.getreportattendancetostudent');
    Route::get('/admin/getreportattendance', [Attendancecontroller::class, 'getrepotr'])->name('admin.getreportattendance');
    Route::get('/admin/getreportgrade', [Gradecontroller::class, 'getrepotr'])->name('admin.getreportgrade');
    Route::get('/admin/getreportgradetostudent', [Studentcontroller::class, 'getrepotrgrade'])->name('admin.getreportgradetostudent');


    

    Route::get('pdf/attendance/class', [PDFController::class, "attendanceforclass"])->middleware(['auth', 'verified'])->name("pdf.attendanceforclass");
    Route::get('pdf/attendance/student', [PDFController::class, "attendanceforstudent"])->middleware(['auth', 'verified'])->name("pdf.attendanceforstudent");
    Route::get('pdf/grade/class', [PDFController::class, "gradeforclass"])->middleware(['auth', 'verified'])->name("pdf.gradeforclass");
    Route::get('pdf/grade/student', [PDFController::class, "gradeforstudent"])->middleware(['auth', 'verified'])->name("pdf.gradeforstudent");







    Route::prefix('schedules')->group(function () {
        Route::get('/', [ScheduleController::class, 'index'])->name('schedules.index');
        Route::get('/create', [ScheduleController::class, 'create'])->name('schedules.create');
        Route::post('/', [ScheduleController::class, 'store'])->name('schedules.store');


        Route::get('/classes/{level}', [ScheduleController::class, 'getClasses']);
        Route::get('/subjects/{class}', [ScheduleController::class, 'getSubjects']);
        Route::get('/getteachers/{subject}', [ScheduleController::class, 'getTeachers']);
        Route::get('/free-periods', [ScheduleController::class, 'getFreeSlots']);
    });


});


















require __DIR__ . '/auth.php';
