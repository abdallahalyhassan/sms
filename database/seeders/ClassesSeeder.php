<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       for( $i=1;$i<=6;$i++){
          
            ClassModel::create([
                  'name' => "level ".$i ."/ class "."1" ,
                  "level_id"=> $i
                  
            ]);
        }

        
    }
}
