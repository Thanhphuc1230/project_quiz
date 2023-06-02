<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tp_category extends Model
{
    protected $table = 'tp_categories';
    protected $primaryKey = 'id_category';
    use HasFactory;

    protected $fillable = [
        'name_cate',
        'uuid_category',
        'status_cate',
        'parent_id',
    ];
}
