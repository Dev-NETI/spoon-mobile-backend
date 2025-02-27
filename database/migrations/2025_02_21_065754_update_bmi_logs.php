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
        Schema::table('bmi_logs', function (Blueprint $tables) {
            $tables->float('height')->after('bmi_category_id');
            $tables->float('weight')->after('height');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bmi_logs', function (Blueprint $tables) {
            $tables->dropColumn('height');
            $tables->dropColumn('weight');
        });
    }
};
