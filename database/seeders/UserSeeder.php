<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            User::create([
                'uuid' => Str::uuid(),
                'fullname' => 'Admin DTP',
                'email' => 'thanhphuc15052001@gmail.com',
                'email_verified_at' => Carbon::now(),
                'status_user' => 1,
                'level' => 1,
            ]);
    }
}
