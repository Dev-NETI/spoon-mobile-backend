<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userData = User::all();

        foreach ($userData as $data) {
            $data->update([
                'slug' => encrypt('id'),
                'password' => Hash::make('password'),
            ]);
        }
    }
}
