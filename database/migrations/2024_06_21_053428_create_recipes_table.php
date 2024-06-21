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
        Schema::create('recipes', function (Blueprint $table) {
            $table->id();
            $table->text('slug')->nullable();
            $table->text('name')->nullable();
            $table->boolean('breakfast')->default(false);
            $table->boolean('lunch')->default(false);
            $table->boolean('dinner')->default(false);
            $table->boolean('snack')->default(false);
            $table->float('calories')->default(0);
            $table->float('carbohydrate')->default(0);
            $table->float('protein')->default(0);
            $table->float('fat')->default(0);
            $table->float('sodium')->default(0);
            $table->float('fiber')->default(0);
            $table->unsignedBigInteger('meal_type_id')->nullable();
            $table->unsignedBigInteger('recipe_origin_id')->nullable();
            $table->integer('number_of_serving')->default(1);
            $table->text('image_path')->nullable();
            $table->boolean('is_active')->default(true);
            $table->text('modified_by')->nullable();
            $table->timestamps();

            $table->foreign('meal_type_id')->references('id')->on('meal_types');
            $table->foreign('recipe_origin_id')->references('id')->on('recipe_origins');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('recipes');
    }
};
