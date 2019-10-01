<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookingDetailTableSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('booking_details')->insert(
            [
	           'user_id' => 1,
	           'car_id' => 1,
	           'booking_date' => '2019-07-09 03:07:91',
	           'start_date' => '2019-07-11 09:07:91',
	           'end_date' => '2019-07-15 09:07:91',
	           'place_delivery' => 'Cầu giấy, Hà Nội',
	           'status' => 1,
           ]
       	);
       	DB::table('booking_details')->insert(
            [
	           'user_id' => 1,
	           'car_id' => 2,
	           'booking_date' => '2019-07-09 02:07:91',
	           'start_date' => '2019-07-14 09:07:91',
	           'end_date' => '2019-07-19 09:07:91',
	           'place_delivery' => 'Chùa Hà, Hà Nội',
	           'status' => 1,
           ]
       	);
       	DB::table('booking_details')->insert(
            [
	           'user_id' => 1,
	           'car_id' => 3,
	           'booking_date' => '2019-07-05 03:07:91',
	           'start_date' => '2019-07-18 09:07:91',
	           'end_date' => '2019-07-30 09:07:91',
	           'place_delivery' => 'Thanh xuân, Hà Nội',
	           'status' => 1,
           ]
       	);
    }
}
