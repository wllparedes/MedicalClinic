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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constraint('patients');
            $table->foreignId('doctor_id')->nullable()->constraint('users');
            $table->string('motive');
            $table->date('date');
            $table->time('start');
            $table->time('end');
            $table->string('message')->nullable();
            $table->enum('type', ['normal', 'virtual'])->default('normal');
            $table->text('link')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
