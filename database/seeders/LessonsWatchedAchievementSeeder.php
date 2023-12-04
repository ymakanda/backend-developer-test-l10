<?php

namespace Database\Seeders;

use App\Models\LessonsWatchedAchievement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LessonsWatchedAchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $items = [
            '1' => ['title' => 'First Lesson Watched'],
            '2' => ['title' => '5 Lessons Watched'],
            '3' => ['title' => '10 Lessons Watched'],
            '4' => ['title' => '25 Lessons Watched'],
            '5' => ['title' => '50 Lessons Watched'],
            
        ];

        foreach ($items as $item) {
            LessonsWatchedAchievement::create([
                'title' => $item['title']
            ]);
        }
    }
}
