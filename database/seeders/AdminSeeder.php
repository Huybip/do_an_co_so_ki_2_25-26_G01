<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Huy',
            'email' => 'huytranhh3@gmail.com',
            'password' => Hash::make('31082005'),
            'role' => 'admin',
            'phone' => '0844825565',
            'address' => 'Roman Plaza, Hanoi, Viet Nam',
        ]);

        User::create([
            'name' => 'Hùng',
            'email' => 'dth025@gmail.com',
            'password' => Hash::make('123456789'),
            'role' => 'admin',
            'phone' => '0987654321',
            'address' => 'Hanoi, Viet Nam',
        ]);
    }
}
