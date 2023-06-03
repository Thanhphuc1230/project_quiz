<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tp_question extends Model
{
    use HasFactory;
    protected $table = 'tp_question';
    protected $primaryKey = 'id_question';

    protected $fillable = [
        'uuid_question',
        'quiz',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
        'answers',
        'explain',
        'status_quiz',
        'category_id',
    ];
}
