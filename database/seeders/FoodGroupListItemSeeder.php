<?php

namespace Database\Seeders;

use App\Models\FoodGroupListItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodGroupListItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $foodGroupData = FoodGroupListItem::all();

        foreach ($foodGroupData as $data) {
            $data->update([
                'slug' => encrypt('id'),
            ]);
        }
    }
}
