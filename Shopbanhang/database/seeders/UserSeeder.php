<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Tạo người dùng mẫu
        User::create([
            'name' => 'John Doe',
            'email' => 'johndoe@example.com',
            'password' => bcrypt('password'), // Mã hóa mật khẩu
        ]);

        // Tạo thêm nhiều người dùng nếu cần
        User::create([
            'name' => 'Jane Doe',
            'email' => 'janedoe@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}