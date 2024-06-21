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
        Schema::create('food_groups', function (Blueprint $table) {
            $table->id();
            $table->text('slug')->nullable();
            $table->text('name')->nullable();
            $table->text('image_path')->nullable();
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
        Schema::dropIfExists('food_groups');
    }
};
