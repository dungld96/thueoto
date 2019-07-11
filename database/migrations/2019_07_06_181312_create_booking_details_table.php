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
            $table->string('user_id');
            $table->string('car_id');
            $table->string('booking_date');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('place_delivery');
            $table->string('description')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('status');  // 1: chưa duyệt, 2: đã duyêt, 3: kết thúc
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
