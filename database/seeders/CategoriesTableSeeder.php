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
        for ($i = 1; $i <= 10; $i++) {
            tp_category::create([
                'uuid_category' => Str::uuid(),
                'name_cate' => 'Category ' . $i,
                'status_cate' => rand(0, 1),
                'link' => 'Link ' . $i,
                'parent_id' => rand(1, 10),
            ]);
        }
    }
}
