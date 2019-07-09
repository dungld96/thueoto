<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code')->unique();
            $table->string('car_manufacturer');
            $table->string('number_plate')->nullable();;
            $table->string('color')->nullable();;
            $table->integer('seats')->nullable();;
            $table->longText('description')->nullable();
            $table->string('mortgage')->nullable();
            $table->string('rules')->nullable();
            $table->string('status'); // 1: deactive, 2: active , 2: đang book, 3: đã book
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
        Schema::dropIfExists('cars');
    }
}
