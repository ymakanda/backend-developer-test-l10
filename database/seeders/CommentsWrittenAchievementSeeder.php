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
            '1' => ['title' => 'First Comment Written'],
            '2' => ['title' => '3 Comments Written'],
            '3' => ['title' => '5 Comments Written'],
            '4' => ['title' => '10 Comments Written'],
            '5' => ['title' => '10 Comments Written'],
            
        ];

        foreach ($items as $item) {
            CommentsWrittenAchievement::create([
                'title' => $item['title']
            ]);
        }
    }
}
