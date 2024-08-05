<?php

namespace Database\Seeders;

use App\Models\SeasonListItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeasonListItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seasonListItemData = SeasonListItem::all();

        foreach ($seasonListItemData as $data) {
            $data->update([
                'slug' => encrypt('id'),
            ]);
        }
    }
}
