<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    { 
       $levels = ["first", "second", "third", "fourth", "fifth", "six"];

       foreach($levels as $level){
          
            Level::create([
                  'name' => $level ,
                  
            ]);
        }
    }
}
