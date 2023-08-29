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
        Schema::create('setting_webs', function (Blueprint $table) {
            $table->id();
            $table->string('admin_icon')->nullable();
            $table->string('admin_logo_login')->nullable();
            $table->string('admin_logo')->nullable();
            $table->string('user_icon')->nullable();
            $table->string('user_logo_login')->nullable();
            $table->string('user_logo')->nullable();
            $table->string('room_icon')->nullable();
            $table->string('room_logo_login')->nullable();
            $table->string('room_logo')->nullable();
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
        Schema::dropIfExists('setting_webs');
    }
};
