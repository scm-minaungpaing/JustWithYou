<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('user_phone_no');
            $table->string('name');
            $table->string('room');
            $table->boolean('status')->default(false);
            $table->text('image');
            $table->unsignedBigInteger('schdule_id');
            $table->unsignedBigInteger('payment_id');
            $table->timestamps();

            $table->foreign('schdule_id')->references('id')->on('schdules')->onDelete('cascade');
            $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
