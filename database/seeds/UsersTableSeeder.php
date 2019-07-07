<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert(
         	[
            'name' => 'Admin',
            'email' => 'admindemo@gmail.com',
            'phone_number' => '0123456789',
            'password' => bcrypt('admin123'),
        	]
    	);
         DB::table('users')->insert(
         	[
            'name' => 'Dũng',
            'email' => 'dunglvh96@gmail.com',
            'phone_number' => '0375028845',
            'password' => bcrypt('dung123'),
        	]
    	);
    }
}
