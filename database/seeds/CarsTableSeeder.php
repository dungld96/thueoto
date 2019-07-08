<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->insert(
            [
           'code' => 'HD1',
           'name' => 'Huyndai 2018',
           'car_manufacturer' => 'Huyndai',
           'seats' => 4,
           'status' => 2,
           ]
       );
        DB::table('cars')->insert(
            [
                'code' => 'AD1',
                'name' => 'Audi 2017',
                'car_manufacturer' => 'Audi',
                'seats' => 4,
                'status' => 2,
            ]
       );
        DB::table('cars')->insert(
            [
                'code' => 'TYO1',
                'name' => 'Toyota 2017',
                'car_manufacturer' => 'Toyota',
                'seats' => 4,
                'status' => 1,
            ]
       );
    }
}
