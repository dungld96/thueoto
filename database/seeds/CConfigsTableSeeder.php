<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CConfigsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('c_configs')->insert(
            [
           'name' => 'service_costs',
           'value' => '30',
           'default' => '30'
           ]
       );
    }
}
