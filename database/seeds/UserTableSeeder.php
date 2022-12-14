<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',

               'email'=>'admin@gmail.com',

                'role'=>'1',

               'password'=> bcrypt('12345678'),
        ]);
        User::create([
            'name'=>'User',

               'email'=>'user@gmail.com',

                'role'=>'0',

               'password'=> bcrypt('12345678'),
        ]);
    }
}
