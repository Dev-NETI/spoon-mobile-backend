<?php

namespace Database\Seeders;

use App\Models\recipe_rank_list_item;
use App\Models\RecipeRankListItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeRankListItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $recipeRankListItemData = RecipeRankListItem::all();

        foreach ($recipeRankListItemData as $data) {
            $data->update([
                'slug' => encrypt('id'),
            ]);
        }
    }
}
