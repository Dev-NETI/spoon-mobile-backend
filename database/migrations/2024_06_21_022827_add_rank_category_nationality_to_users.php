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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('rank_id')->after('password')->nullable();
            $table->unsignedBigInteger('category_id')->after('rank_id')->nullable();
            $table->unsignedBigInteger('nationality_id')->after('category_id')->nullable();

            $table->foreign('rank_id')->references('id')->on('ranks');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('nationality_id')->references('id')->on('nationalities');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
