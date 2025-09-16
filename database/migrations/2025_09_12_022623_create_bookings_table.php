<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('room_name');
            $table->date('date');
            $table->time('time',0);
            $table->string('duration')->nullable();
            $table->integer('number_of_people')->nullable();
            $table->json('equipment')->nullable();
            $table->string('host_name');
            $table->string('meeting_title');
            $table->boolean('is_scan_enabled')->default(false);
            $table->string('scan_info')->nullable();
            $table->string('status')->default('upcoming');
            $table->string('location')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
