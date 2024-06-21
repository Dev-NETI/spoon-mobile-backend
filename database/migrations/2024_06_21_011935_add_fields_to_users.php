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
            $table->text('slug')->after('id')->nullable();
            $table->text('firstname')->after('slug')->nullable();
            $table->text('middlename')->after('firstname')->nullable();
            $table->text('lastname')->after('middlename')->nullable();
            $table->text('suffix')->after('lastname')->nullable();
            $table->text('company')->after('password')->nullable();
            $table->integer('age')->after('company')->nullable();
            $table->date('date_of_birth')->after('age')->nullable();
            $table->text('height_imperial')->after('date_of_birth')->comment('height = ft , in (ex 5\'5ft ).')->nullable();
            $table->text('height_metric')->after('height_imperial')->comment('height = cm ex(180cm)')->nullable();
            $table->text('weight_imperial')->after('height_metric')->comment('weight = pounds/lbs (ex 250 lbs )')->nullable();
            $table->text('weight_metric')->after('weight_imperial')->comment('weight = kg (ex. 65kg)')->nullable();
            $table->text('image_path')->after('weight_metric')->nullable();
            $table->boolean('is_active')->after('image_path')->default(true);
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
