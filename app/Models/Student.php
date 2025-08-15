<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'user_id',
        'class_id',
        'parent_id',
        'dob',
        "level",
        'gender',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function class()
    {
        return $this->belongsTo(ClassModel::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }
    public function exams()
    {
        return $this->belongsToMany(Exam::class)->withPivot('start_time', 'submitted_at')->withTimestamps();
    }
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }

    public function parent()
    {
        return $this->belongsTo(StudentParent::class, 'parent_id');
    }
}
