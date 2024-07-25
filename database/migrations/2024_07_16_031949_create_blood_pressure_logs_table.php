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
        Schema::create('blood_pressure_logs', function (Blueprint $table) {
            $table->id();
            $table->text('slug')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->integer('systolic')->nullable();
            $table->integer('diastolic')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blood_pressure_logs');
    }
};
