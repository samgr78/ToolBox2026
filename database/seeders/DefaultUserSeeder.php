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
        User::firstOrCreate(
            ['email' => 'admin@toolbox.test'],
            [
                'first_name' => 'userseeder1',
                'last_name'  => 'lastnameseeder1',
                'email' => 'userseeder1@gmail.com',
                'password'   => Hash::make('password'),
            ]
        );
    }
}
