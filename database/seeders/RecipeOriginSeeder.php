<?php

namespace Database\Seeders;

use App\Models\RecipeOrigin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RecipeOriginSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        RecipeOrigin::truncate();
        $data = [
            0 => ['FILIPINO', '../imageicon/ph.jpg'],
            1 => ['JAPANESE', '../imageicon/jap.jpg'],
            2 => ['MYANMAR', '../imageicon/myanmar flag.jpg'],
            3 => ['VIETNAM', '../imageicon/vietnam.jpg'],
            4 => ['INDONESIAN', '../imageicon/indonesia.jpg'],
            5 => ['INDIAN', '../imageicon/india flag.jpg'],
            6 => ['ARMENIAN', '../imageicon/armenia flag.png'],
            7 => ['BULGARIAN', '../imageicon/bulgaria flag.png'],
            8 => ['CROATIAN', '../imageicon/croatia flag.jpg'],
            9 => ['ROMANIAN', '../imageicon/romanian flag.png'],
            10 => ['RUSSIAN', '../imageicon/russian flag.png'],
            11 => ['SLOVENIAN', '../imageicon/slovenian flag.png'],
            12 => ['UKRANIAN', '../imageicon/ukranian flag.jpg'],
            13 => ['CHINESE', '../imageicon/chinese flag.jpg'],
        ];

        foreach ($data as $index => [$name, $imagePath]) {
            RecipeOrigin::create([
                'name' => $name,
                'image_path' => $imagePath,
            ]);
        }
    }
}
