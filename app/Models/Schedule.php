<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  protected $fillable = [
        'teacher_id',
        'class_id',
        'subject_id',
        'day_of_week',
        'period',
    ];
      public function class()
    {
        return $this->belongsTo(ClassModel::class,"class_id");
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
  
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
