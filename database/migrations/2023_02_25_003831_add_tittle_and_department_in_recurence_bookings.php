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
        Schema::table('recurrence_bookings', function (Blueprint $table) {
            $table->string('title')->nullable()->after('id');
            $table->integer('division_id')->nullable()->after('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recurrence_bookings', function (Blueprint $table) {
            $table->dropColumn(['title', 'division_id']);
        });
    }
};
