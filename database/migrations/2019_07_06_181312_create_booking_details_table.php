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
            $table->dateTime('booking_date');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('place_delivery', 100);
            $table->longText('description')->nullable();
            $table->string('discount_code', 100)->nullable();
            $table->smallInteger('status');  // 1: chưa duyệt, 2: đã duyêt, 3: kết thúc
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
