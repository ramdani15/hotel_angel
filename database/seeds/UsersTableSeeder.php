<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
        	[
        		'name' => 'admin',
        		'username' => 'admin',
        		'email' => 'admin@gmail.com',
        		'role' => 'admin',
        		'password' => Hash::make(123),
        	],
        	[
        		'name' => 'customer 1',
        		'username' => 'customer1',
        		'email' => 'customer1@gmail.com',
        		'role' => 'customer',
        		'password' => Hash::make(123),
        	],
        	[
        		'name' => 'customer 2',
        		'username' => 'customer2',
        		'email' => 'customer2@gmail.com',
        		'role' => 'customer',
        		'password' => Hash::make(123),
        	],
        ]);
    }
}
