<?php

namespace Database\Seeders;

use App\entity\user\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DefaultUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'first_name' => 'admin1',
                'last_name' => 'lastnameadmin1',
                'email' => 'admin1@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'first_name' => 'teacher1',
                'last_name' => 'lastnameteacher1',
                'email' => 'teacher1@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'first_name' => 'student1',
                'last_name' => 'lastnamestudent1',
                'email' => 'student@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
