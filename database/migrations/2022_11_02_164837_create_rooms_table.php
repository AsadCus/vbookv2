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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->string('capacity')->nullable();
            $table->string('floor')->nullable();
            $table->string('ip_address')->nullable();
            $table->string('color_code')->nullable();
            $table->integer('device_id')->nullable();
            $table->integer('projector')->nullable();
            $table->text('calendar_id')->nullable();
            $table->text('base_id')->nullable();
            $table->text('taphome_on')->nullable();
            $table->text('taphome_off')->nullable();
            $table->boolean('status')->nullable()->default(1)->comment('(1:aktif) (2:non-aktif)');
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
        Schema::dropIfExists('rooms');
    }
};
