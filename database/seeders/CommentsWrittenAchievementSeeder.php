<?php

namespace Database\Seeders;

use App\Models\CommentsWrittenAchievement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommentsWrittenAchievementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $items = [
            '1' => ['number_of_comments' => 1, 'title' => 'First Comment Written'],
            '2' => ['number_of_comments' => 3, 'title' => 'Comments Written'],
            '3' => ['number_of_comments' => 5, 'title' => 'Comments Written'],
            '4' => ['number_of_comments' => 10, 'title' => 'Comments Written'],
            '5' => ['number_of_comments' => 20, 'title' => 'Comments Written'],
            
        ];

        foreach ($items as $item) {
            CommentsWrittenAchievement::create([
                'number_of_comments' => $item['number_of_comments'],
                'title' => $item['title']
            ]);
        }
    }
}
