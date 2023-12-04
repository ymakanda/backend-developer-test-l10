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
            'Beginner' => ['description' => '0 Achievements'],
            'Intermediate' => ['description' => '4 Achievements'],
            'Advanced' => ['description' => '8 Achievements'],
            'Master' => ['description' => '10 Achievements'],
            
        ];

        foreach ($items as $key => $item) {
            Badge::create([
                'title' => $key,
                'description' => $item['description'],
            ]);
        }
    }
}
