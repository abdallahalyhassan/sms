<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use App\Models\Level;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    public function getalllevels(){
        $levels=Level::all();
        return $levels;
    }
     public function getlevelsbyclasses(){
        $classes=ClassModel::all()->groupBy('level');
        return $classes;
    }


}
