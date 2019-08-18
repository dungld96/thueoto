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
            $table->string('make_code', 45); // hãng xe
            $table->string('model_code', 45); // mẫu xe
            $table->string('car_year', 100); // năm sản xuất
            $table->string('number_plate', 100)->unique(); // bien so
            $table->string('color', 100)->nullable(); //màu xe
            $table->smallInteger('seats')->nullable();
            $table->string('transmission', 45)->nullable(); // kiểu số auto: số tự động, manual: số sàn
            $table->string('fuel', 45)->nullable(); // kiểu nhiên liệu diesel: dầu diesel, petrol: xăng
            $table->integer('consumption')->nullable(); // mức tiêu thụ nhiên liệu trên 100km
            $table->string('function')->nullable(); // chức năng
            $table->mediumText('description')->nullable(); // mô tả
            $table->mediumText('mortgage')->nullable(); // điều kiện thế chấp
            $table->mediumText('rules')->nullable(); // yêu cầu
            $table->string('thumbnail')->nullable();
            $table->string('car_spec')->nullable();
            $table->integer('costs');
            $table->integer('promotion_costs')->nullable();
            $table->string('slug')->unique();
            $table->string('is_top', 10)->nullable()->default('F'); // F: false, T: true
            $table->string('status', 10)->default('active');
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
