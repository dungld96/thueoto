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
        DB::table('c_configs')->insert(
            [
                'name' => 'info_system',
                'value' => '{"address":"Sân bay Nội Bài - Sóc Sơn - Hà Nội","phone_number_1":"08 6869 8682","phone_number_2":"0246 327 8686","email":"vinhtin2069@gmail.com"}',
                'default' => '{"address":"Sân bay Nội Bài - Sóc Sơn - Hà Nội","phone_number_1":"08 6869 8682","phone_number_2":"0246 327 8686","email":"vinhtin2069@gmail.com"}'
            ]
       );
    }
}
