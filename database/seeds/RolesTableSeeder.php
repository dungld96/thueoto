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
        for ($i=0; $i < 4; $i++) { 
            DB::table('roles')->insert(
                [
                    'role' => $i+1,
                    'description' => 'role'
                ]
           );
        }
    }
}
