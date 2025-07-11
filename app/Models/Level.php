<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
     public function classes()
    {
        return $this->hasMany(ClassModel::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class);
    }
}
