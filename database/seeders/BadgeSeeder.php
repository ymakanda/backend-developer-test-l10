<?php

namespace Database\Seeders;

use App\Models\Badge;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $items = [
            'Beginner' => ['number_of_badges' => 0, 'description' => 'Achievements'],
            'Intermediate' => ['number_of_badges' => 4, 'description' => 'Achievements'],
            'Advanced' => ['number_of_badges' => 8, 'description' => 'Achievements'],
            'Master' => ['number_of_badges' => 10, 'description' => 'Achievements'],
            
        ];

        foreach ($items as $key => $item) {
            Badge::create([
                'title' => $key,
                'number_of_badges' => $item['number_of_badges'],
                'description' => $item['description'],
            ]);
        }
    }
}
