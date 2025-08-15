<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['type', 'question', 'options', 'correct_answer', 'points', 'subject_id'];

   protected $casts = [
        'options' => 'array', 
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function exams()
    {
        return $this->belongsToMany(Exam::class);
    }
}
