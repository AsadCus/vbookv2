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
        Schema::table('users', function (Blueprint $table) {
            $table->string('merge_room')->nullable()->after('remember_token');
            $table->integer('device_merge')->nullable()->after('merge_room');
            $table->string('ip_address_merge_room')->nullable()->after('device_merge');
            $table->integer('merge_room_id')->nullable()->after('ip_address_merge_room');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['merge_room', 'device_merge', 'ip_address_merge_room', 'merge_room_id']);
        });
    }
};
