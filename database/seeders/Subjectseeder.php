<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Subjectseeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = ['arabic', 'math', 'english'];
        for ($i = 1; $i <= 3; $i++) {
            foreach ($subjects as $subject) {
                Subject::create([
                    'name' => $subject,
                    "level" => $i

                ]);
            }

        }

        $subjects = ['arabic', 'math', 'english', 'science', 'history', 'religious'];

        for ($i = 4; $i <= 6; $i++) {
            foreach ($subjects as $subject) {
                Subject::firstOrCreate([
                    'name' => $subject,
                    "level" => $i

                ]);
            }

        }
    }
}
