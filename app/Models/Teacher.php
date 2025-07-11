<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    //
    protected $fillable = [
        'user_id',
        'phone',
        "subject"
    ];



    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }



}
