<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{



    protected $fillable = [
        'name',
        "level_id",

    ];


    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    public function teacher()
    {
        return $this->belongsToMany(Teacher::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
     public function grade()
    {
        return $this->hasMany(Grade::class);
    }
       public function exams()
    {
        return $this->hasMany(Exam::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
   
}


