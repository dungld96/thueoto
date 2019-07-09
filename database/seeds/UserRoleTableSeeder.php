<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            DB::table('role_user')->insert(
                [
                    'user_id' => 1,
                    'role_id' => 3,
                ]
           );

           DB::table('role_user')->insert(
            [
                'user_id' => 2,
                'role_id' => 1,
            ]
       );
    }
}
