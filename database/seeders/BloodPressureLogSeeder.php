<?php

namespace Database\Seeders;

use App\Models\BloodPressureLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BloodPressureLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bpLogData = BloodPressureLog::all();

        foreach ($bpLogData as $data) {
            $data->update([
                'slug' => encrypt('id'),
            ]);
        }
    }
}
