<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{



    protected $fillable = [
        'name',
        "level",

    ];


    public function students()
    {
        return $this->belongsToMany(Student::class);
    }
    public function levels()
    {
        return $this->belongsToMany(Level::class);
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



}


