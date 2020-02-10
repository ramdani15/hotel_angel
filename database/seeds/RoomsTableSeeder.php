<?php

use Illuminate\Database\Seeder;

use App\Rooms;


class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rooms::insert([
        	[
        		'name' => 'Room A',
        		'price' => 1000000,
        		'status' => 'available',
        	],
        	[
        		'name' => 'Room B',
        		'price' => 2000000,
        		'status' => 'available',
        	],
        	[
        		'name' => 'Room C',
        		'price' => 3000000,
        		'status' => 'available',
        	],
        ]);
    }
}
