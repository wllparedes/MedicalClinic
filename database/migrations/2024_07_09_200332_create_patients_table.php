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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('names');
            $table->string('last_names');
            $table->string('slug')->unique();
            $table->string('username')->unique();
            $table->string('gender', 1)->nullable();
            $table->date('birthday')->nullable();
            $table->string('address')->nullable();
            $table->string('dni', 15);
            $table->string('phone', 15);
            $table->string('emergency_phone', 15)->nullable();
            $table->string('email');
            $table->string('password');
            $table->string('nationality', 2)->nullable();
            $table->boolean('active')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
