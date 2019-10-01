<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(
            [
                'role' => 0,
                'description' => 'Ban user'
            ]
       );

       DB::table('roles')->insert(
            [
                'role' => 1,
                'description' => 'Customer'
            ]
        );

       DB::table('roles')->insert(
            [
                'role' => 2,
                'description' => 'Moderator'
            ]
        );

       DB::table('roles')->insert(
            [
                'role' => 3,
                'description' => 'Administrator'
            ]
        );


    }
}
