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
        Schema::create('medical_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients');
            $table->string('allergies')->nullable();
            $table->string('past_illnesses')->nullable();
            $table->string('family_history')->nullable();
            $table->string('surgeries')->nullable();
            $table->string('vaccinations')->nullable();
            $table->string('social_history')->nullable();
            $table->string('medications')->nullable();
            $table->string('blood_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_histories');
    }
};
