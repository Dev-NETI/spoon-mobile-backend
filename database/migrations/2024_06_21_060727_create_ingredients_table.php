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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->text('slug')->nullable();
            $table->unsignedBigInteger('recipe_id')->nullable();
            $table->text('name')->nullable();
            $table->text('instruction')->nullable();
            $table->float('quantity')->nullable();
            $table->unsignedBigInteger('unit_id')->nullable();
            $table->float('calories')->default(0);
            $table->float('carbohydrate')->default(0);
            $table->float('protein')->default(0);
            $table->float('fat')->default(0);
            $table->float('sodium')->default(0);
            $table->float('fiber')->default(0);
            $table->boolean('is_active')->default(true);
            $table->text('modified_by')->nullable();
            $table->timestamps();

            $table->foreign('recipe_id')->references('id')->on('recipes');
            $table->foreign('unit_id')->references('id')->on('units');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
