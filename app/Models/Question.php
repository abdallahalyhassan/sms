<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
       protected $fillable = [
        'exam_id',
        'question',
        'type',
        'correct_answer',
    ];

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
