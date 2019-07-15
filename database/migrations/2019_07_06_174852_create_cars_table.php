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
            $table->string('name', 100);
            $table->string('code', 100)->unique();
            $table->string('car_manufacturer', 100);
            $table->string('number_plate', 100)->nullable();;
            $table->string('color', 100)->nullable();;
            $table->smallInteger('seats')->nullable();;
            $table->longText('description')->nullable();
            $table->string('mortgage')->nullable();
            $table->longText('rules')->nullable();
            $table->string('thumbnail')->nullable();
            $table->integer('costs');
            $table->string('slug')->unique();
            $table->smallInteger('status'); // 1: deactive, 2: active
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
