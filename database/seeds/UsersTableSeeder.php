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
            'name' => 'Administrator',
            'email' => 'admindemo@gmail.com',
            'password' => bcrypt('admin2019'),
        	]
        );

        DB::table('users')->insert(
            [
           'name' => 'Moderator',
           'email' => 'moderator@gmail.com',
           'phone_number' => '0868698682',
           'password' => bcrypt('mod2019'),
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
