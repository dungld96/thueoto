<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->string('email', 100)->unique()->nullable();
            $table->string('phone_number', 100)->unique()->nullable();
            $table->string('password', 100);
            $table->char('sex', 1)->nullable();
            $table->date('birthday')->nullable();
            $table->string('social_type')->nullable();
            $table->string('social_id')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
