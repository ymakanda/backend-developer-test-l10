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
            '1' => ['number_of_lessons' => 1, 'title' => 'First Lesson Watched'],
            '2' => ['number_of_lessons' => 5, 'title' => 'Lessons Watched'],
            '3' => ['number_of_lessons' => 10, 'title' => 'Lessons Watched'],
            '4' => ['number_of_lessons' => 25, 'title' => 'Lessons Watched'],
            '5' => ['number_of_lessons' => 50, 'title' => 'Lessons Watched'],
            
        ];

        foreach ($items as $item) {
            LessonsWatchedAchievement::create([
                'number_of_lessons' => $item['number_of_lessons'],
                'title' => $item['title']
            ]);
        }
    }
}
