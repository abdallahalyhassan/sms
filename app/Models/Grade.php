<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
     protected $fillable = [
        'student_id',
        'exam_id',
        'grade',
        'type',
        'subject_id',
        'max_grade',
    ];




     public function Exam()
    {
        return $this->belongsTo(Exam::class);
    }
       public function student()
    {
        return $this->belongsTo(student::class);
    }
        public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
