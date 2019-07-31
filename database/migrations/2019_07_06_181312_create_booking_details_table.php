<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('car_id');
            $table->string('trip_code', 10)->unique();
            $table->dateTime('booking_date');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('place_delivery', 100);
            $table->mediumInteger('costs');
            $table->mediumInteger('promotion_costs')->nullable();
            $table->mediumInteger('service_costs')->nullable();
            $table->mediumInteger('discount')->nullable();
            $table->mediumInteger('sum_amount');
            $table->longText('description')->nullable();
            $table->smallInteger('status');  
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('booking_details');
    }
}
