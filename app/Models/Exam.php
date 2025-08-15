<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
     protected $fillable = ['title', 'description', 'start_time', 'end_time', 'duration', 'subject_id'];

     public function student()
{
    return $this->belongsToMany(User::class)->withPivot('start_time', 'submitted_at')->withTimestamps();
}

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

     public function grade()
    {
        return $this->hasOne(Grade::class);
    }
    
}
