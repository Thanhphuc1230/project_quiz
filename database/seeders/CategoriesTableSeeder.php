<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\tp_category;
class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        tp_category::insert([
            [
                'uuid_category' => Str::uuid(),
                'name_cate' => 'Toán',
                'status_cate' => 1,
                'link' => NULL,
                'parent_id' => 1
            ],
            [
                'uuid_category' => Str::uuid(),
                'name_cate' => 'Anh Văn',
                'status_cate' => 1,
                'link' => NULL,
                'parent_id' => 1
            ],
            [
                'uuid_category' => Str::uuid(),
                'name_cate' => 'Vật Lý',
                'status_cate' => 1,
                'link' => NULL,
                'parent_id' => 1
            ],
            [
                'uuid_category' => Str::uuid(),
                'name_cate' => 'Hóa Học',
                'status_cate' => 1,
                'link' => NULL,
                'parent_id' => 1
            ],
        ]);
    }
}
