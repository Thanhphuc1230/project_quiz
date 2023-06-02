<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\tp_question;
use Illuminate\Support\Str;
use App\Models\tp_category;
class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   

        for ($i = 1; $i <= 100; $i++) {
            tp_question::create([
                'uuid_question' => Str::uuid(),
                'quiz' => 'Question ' . $i,
                'option_a' => 'Option A',
                'option_b' => 'Option B',
                'option_c' => 'Option C',
                'option_d' => 'Option D',
                'answers' => 'Option A',
                'explain' => 'Explanation for Question ' . $i,
                'category_id' =>random_int(1,10),
            ]);
        }
    }
}
