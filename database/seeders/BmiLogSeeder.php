<?php

namespace Database\Seeders;

use App\Models\BmiLog;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BmiLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Truncate the BmiLog table
        BmiLog::truncate();
        
        // Fetch all user IDs
        $userIds = User::pluck('id')->toArray();
        
        // Loop to create 50 BMI logs
        for ($x = 1; $x <= 50; $x++) {
            BmiLog::create([
                'user_id' => $userIds[array_rand($userIds)], // Random user ID from the list
                'bmi' => rand(1500, 5000) / 100, // Generate random BMI value between 18.00 and 30.00
            ]);
        }
    }
}
