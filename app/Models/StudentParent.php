<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentParent extends Model
{
    protected $fillable = [
        'user_id',
        'phone'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
     public function children()
    {
        return $this->hasMany(Student::class,'parent_id');
    }
}
