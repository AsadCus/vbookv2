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
        Schema::create('merge_rooms', function (Blueprint $table) {
            $table->id();
            $table->integer('room_id')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('user_device1')->nullable();
            $table->integer('user_device2')->nullable();
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
        Schema::dropIfExists('merge_rooms');
    }
};
