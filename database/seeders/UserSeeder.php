<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff_provinces;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //akun headstaff
        User::create([
            'email' => 'headstaff_jabar@gmail.com',
            'password' => Hash::make('jabar123'),
            'role' => 'HEAD_STAFF',
        ]);

        Staff_provinces::create([
            'user_id' => '1',
            'province' => 'JAWA BARAT',
        ]);
    }
}
