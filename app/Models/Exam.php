<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
     protected $fillable = [
        'student_id',
        'sub_id',
        'date'
    ];

     public function grade()
    {
        return $this->hasOne(Grade::class);
    }
     public function student()
    {
        return $this->belongsTo(Student::class);
    }
     public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
      public function question()
    {
        return $this->hasMany(Question::class);
    }
}
