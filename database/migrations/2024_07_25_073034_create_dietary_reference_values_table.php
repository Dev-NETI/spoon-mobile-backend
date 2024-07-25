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
        Schema::create('dietary_reference_values', function (Blueprint $table) {
            $table->id();
            $table->text('slug')->nullable();
            $table->text('name')->nullable();
            $table->double('calories')->nullable();
            $table->double('carbohydrate')->nullable();
            $table->double('protein')->nullable();
            $table->double('fat')->nullable();
            $table->double('sodium')->nullable();
            $table->double('fiber')->nullable();
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
        Schema::dropIfExists('dietary_reference_values');
    }
};
