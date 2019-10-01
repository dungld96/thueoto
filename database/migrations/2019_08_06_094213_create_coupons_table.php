<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function (Blueprint $table) {
            $table->increments('id');
            $table->string( 'code', 45 )->unique();
            $table->string( 'name' );
            $table->text( 'description' )->nullable( );
            $table->integer( 'discount_amount' );
            $table->integer( 'max_discount' )->nullable( );
            $table->date( 'starts_at' );
            $table->date( 'expires_at' );
            $table->string('status', 10)->default('active');
            $table->timestamps( );
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coupons');
    }
}
