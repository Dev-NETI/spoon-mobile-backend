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
        Schema::create('recommended_calorie_intake_history_items', function (Blueprint $table) {
            $table->id();
            $table->text('slug')->nullable();
            $table->integer('user_id')->nullable();
            $table->double('maintenance_calorie')->nullable();
            $table->double('mild_weight_loss')->nullable();
            $table->double('weight_loss')->nullable();
            $table->double('extreme_weight_loss')->nullable();
            $table->double('mild_weight_gain')->nullable();
            $table->double('weight_gain')->nullable();
            $table->double('extreme_weight_gain')->nullable();
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
        Schema::dropIfExists('recommended_calorie_intake_history_items');
    }
};
