<?php

namespace Database\Seeders;

use App\Models\Procedure;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProcedureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $procedureData = Procedure::all();

        foreach ($procedureData as $data) {
            $data->update([
                'slug' => encrypt('id'),
            ]);
        }
    }
}
