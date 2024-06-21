<?php

namespace Database\Seeders;

use App\Models\FoodGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FoodGroup::truncate();
        $data = [
            0 => ['Pork', '../imageicon/pork.jpg'],
            1 => ['Beef', '../imageicon/beef.jpg'],
            2 => ['Chicken', '../imageicon/chicken.jpg'],
            3 => ['Lamb / Mutton', '../imageicon/lambmutton.jpg'],
            4 => ['Seafood', '../imageicon/seafood.jpg'],
            5 => ['Vegetable', '../imageicon/vegetables.jpg'],
            6 => ['Fruits', '../imageicon/fruits.jpg'],
            7 => ['Rice Product', '../imageicon/riceproduct.jpg'],
            8 => ['Noodles', '../imageicon/noodles.jpg'],
            9 => ['Bread', '../imageicon/bakery.jpg'],
            10 => ['Soup', '../imageicon/soup.jpg'],
            11 => ['Pastries', ''],
        ];
        foreach ($data as $index => [$name, $imagePath]) {
            FoodGroup::create([
                'name' => $name,
                'image_path' => $imagePath,
            ]);
        }
    }
}
