<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
require_once(app_path().'/Library/simple_html_dom.php');
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
class CrawlerController extends Controller
{
    public function index(){
        $link ='https://tech12h.com/bai-hoc/trac-nghiem-tieng-anh-12-unit-1-home-life-p2.html';
        $html = file_get_html($link);

        $content = $html->find('#accordionExample', 0);
    
        $quizArray = [];
        $answerOptionsArray = [];
        $i = 1;
    
        foreach ($content->find('p') as $index => $title) {
            $quizArray[$index] = preg_replace('/^Câu \d+:\s/', '', $title->plaintext);
            $quizArray[$index] = str_replace('&nbsp;', '', $quizArray[$index]);
            
        }
    
        foreach ($content->find('ul') as $index => $answers) {
            $answerOptions = $answers->find('li');
    
            foreach ($answerOptions as $option) {
                $answer = preg_replace('/^[A-D].\s/', '', $option->plaintext);
                $answer = preg_replace('/^[a-d].\s/', '', $option->plaintext);
                $answer = str_replace('&nbsp;', '', $answer);
                $answerOptionsArray[$index][] = $answer;
            }
        }
   
        foreach ($quizArray as $index => $quiz) {
            $existingQuestion = DB::table('tp_question')->where('quiz', $quiz)->first();
            if (!$existingQuestion) {
                if (isset($answerOptionsArray[$index])) {
                    DB::table('tp_question')->insert([
                        'uuid_question' => Str::uuid(),
                        'quiz' => $quiz,
                        'option' => json_encode($answerOptionsArray[$index]),
                        'answers' => 'a',
                        'explain' => null,
                        'status_quiz' => 0,
                        'category_id' => 10,
                        'created_at' => now()
                    ]);
                    $i++;
                } else {
                    continue; // Skip this iteration if the key does not exist
                }
            }
          
        }
        echo 'success get data '.$i .' question';
    }
}
