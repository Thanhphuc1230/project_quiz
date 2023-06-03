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
        $options = ['a', 'b', 'c', 'd'];
        $randomOption = $options[array_rand($options)];
        for ($i = 1; $i <= 20; $i++) {
            tp_question::create([
                'uuid_question' => Str::uuid(),
                'quiz' => 'Question ' . $i,
                'option_a' => 'Option A',
                'option_b' => 'Option B',
                'option_c' => 'Option C',
                'option_d' => 'Option D',
                'answers' => $randomOption,
                'explain' => 'Explanation for Question ' . $i,
                'status_quiz' => '1',
                'category_id' =>random_int(1,10),
            ]);
        }
    }
}
