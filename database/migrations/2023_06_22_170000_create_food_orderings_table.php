<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_orderings', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('user_id');
            // $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('booking_id');
            $table->foreign('booking_id')->references('id')->on('booking_rooms');
            // $table->foreignId('user_id')
            //     ->constrained('users')
            //     ->cascadeOnDelete()
            //     ->cascadeOnUpdate();
            // $table->foreignId('booking_id')
            //     ->constrained('booking_rooms')
            //     ->cascadeOnDelete()
            //     ->cascadeOnUpdate();
            // $table->foreignId('food_id')
            //     ->constrained('foods')
            //     ->cascadeOnDelete()
            //     ->cascadeOnUpdate();
            // $table->integer('pieces');
            $table->string('status');
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
        Schema::dropIfExists('food_orderings');
    }
};
