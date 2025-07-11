<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{

    protected $table = 'classes';
    protected $fillable = [
        'name',
        "capacity",
        "current_students",
        "level_id"
    ];
    
    
    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'class_id');
    }
     public function level()
    {
        return $this->belongsTo(Level::class);
    }

     public function schedules()
    {
        return $this->hasMany(Schedule::class,'class_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }
}
