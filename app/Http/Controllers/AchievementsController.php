<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Badge;
use App\Models\CommentsWrittenAchievement;
use App\Models\LessonsWatchedAchievement;
use App\Models\UserAchievementsAndBadge;

use Illuminate\Http\Request;

class AchievementsController extends Controller
{
    public function index(User $user)
    {
        $unlocked_achievements = [];
        $badgeAchievements = Badge::all();
        
        $comments_achievements = User::find($user->id)
            ->comments()
            ->get();
        $total_comments_written = count($comments_achievements);

        $lessons_achievements = User::find($user->id)
            ->watched()
            ->get();
        $total_lessons_watched = count($lessons_achievements);

        $unlocked_achievements = $this->unlocked_achievements($user, $total_comments_written, $total_lessons_watched);
        $next_available_achievements = $this->next_available_achievements($user, $total_comments_written, $total_lessons_watched);
       

        return response()->json([
            'unlocked_achievements' => $unlocked_achievements ,
            'next_available_achievements' => $next_available_achievements,
            'current_badge' => '',
            'next_badge' => '',
            'remaing_to_unlock_next_badge' => 0
        ]);
    }
    public function unlocked_achievements($user, $total_comments_written, $total_lessons_watched) {
        $unlocked_achievements = [];
        $comments_achievements = $this->unlocked_comments_achievements($user, $total_comments_written);
        $lessons_achievements = $this->unlocked_lessons_achievements($user, $total_lessons_watched);
        
        $unlocked_achievements['comments_written_achievement'] =  $comments_achievements['comments_written_achievement'];
        $unlocked_achievements['lessons_watched_achievement'] = $lessons_achievements['lessons_watched_achievement'];

        $this->next_available_achievements($user, $total_comments_written, $total_lessons_watched);
        
        
        
        return $unlocked_achievements;
        
    }
    public function next_available_achievements($user, $total_comments_written, $total_lessons_watched) {
        $next_available_achievements = [];
        $next_available_comments_achievement = $this->next_available_comments_achievement($user, $total_comments_written);
        $next_available_achievements['next_available_comments_achievement'] = $next_available_comments_achievement['next_available_comments_achievement'];
        
        $next_available_lessons_achievement = $this->next_available_lessons_achievement($user, $total_lessons_watched);
        $next_available_achievements['next_available_lessons_achievement'] = $next_available_lessons_achievement['next_available_lessons_achievement'];

        return $next_available_achievements;
    }
    public function unlocked_comments_achievements($user, $total_comments_written) {
        $unlocked_achievements = [];
       
        
        $comments_written_achievements = CommentsWrittenAchievement::all();
        $user_achievements_and_badge = UserAchievementsAndBadge::find($user->id);

        foreach ($comments_written_achievements as $comment_key => $comment) {
            if(($comment->number_of_comments == $total_comments_written) || (($total_comments_written == 1) || ($comment->title == 'First Comment Written'))) {
                if($comment_key == 0) {
                    $achievements = UserAchievementsAndBadge::firstOrCreate(
                        ['user_id' =>  $user->id],
                        ['comments_achievement' => $comment->title]
                    );

                    $unlocked_achievements['comments_written_achievement']= $comment->title;
                    break;
                }
            }
            elseif(($comment->number_of_comments == $total_comments_written) || (($total_comments_written == 3) || ($comment->title == 'Comments Written'))) {
                if($comment_key == 1) {
                    $achievements = UserAchievementsAndBadge::firstOrCreate(
                        ['user_id' =>  $user->id],
                        ['comments_achievement' => $comment->title]
                    );
                    $unlocked_achievements['comments_written_achievement']= $comment->number_of_comments .' '.$comment->title;
                    break;
                }
            }
            elseif(($comment->number_of_comments == $total_comments_written) && ($total_comments_written == 5)) {
                if($comment_key == 2) {
                    $unlocked_achievements['comments_written_achievement']= $comment->number_of_comments .' '.$comment->title;

                    $achievements = UserAchievementsAndBadge::firstOrCreate(
                        ['user_id' =>  $user->id],
                        ['comments_achievement' => $comment->title]
                    );
                    break;
                }
                
            }
            elseif(($comment->number_of_comments == $total_comments_written) && ($total_comments_written == 10)) {
                if($comment_key == 3) {
                    $unlocked_achievements['comments_written_achievement']= $comment->number_of_comments .' '.$comment->title;
                    break;
                }
            }
            elseif(($comment->number_of_comments == $total_comments_written) && ($total_comments_written == 20)) {
                if($comment_key == 4) {
                    $unlocked_achievements['comments_written_achievement']= $comment->number_of_comments .' '.$comment->title;
                    break;
                }
            }
            else
            $unlocked_achievements['comments_written_achievement'] = '';
        }

        return $unlocked_achievements;
    }
    public function next_available_comments_achievement($user, $total_comments_written) {
        $unlocked_next_achievements = [];
        $comments_written_achievements = CommentsWrittenAchievement::all();
        foreach ($comments_written_achievements as $comment_key => $comment) {
            if(($comment->number_of_comments !== $total_comments_written) &&  ($total_comments_written == 0)) {
                if($comment_key == 0) {
                    $unlocked_next_achievements['next_available_comments_achievement']= $comment->title;
                    break;
                }
            }
            elseif(($comment->number_of_comments !== $total_comments_written) && (($total_comments_written == 1) || ($total_comments_written == 2))) {
                if($comment_key == 1) {
                    $unlocked_next_achievements['next_available_comments_achievement']= $comment->number_of_comments .' '.$comment->title;
                    break;
                }
            }
            elseif(($comment->number_of_comments !== $total_comments_written) && (($total_comments_written == 3) || ($total_comments_written == 4))) {
                if($comment_key == 2) {
                    $unlocked_next_achievements['next_available_comments_achievement']= $comment->number_of_comments .' '.$comment->title;
                    break;
                }
            }
            elseif(($comment->number_of_comments !== $total_comments_written) && (($total_comments_written >= 5 ) && ($total_comments_written <= 9))) {
                if($comment_key == 3) {
                    $unlocked_next_achievements['next_available_comments_achievement']= $comment->number_of_comments .' '.$comment->title;
                    break;
                }
                
            }
            elseif(($comment->number_of_comments !== $total_comments_written) && (($total_comments_written >= 10 ) && ($total_comments_written <= 19))) {
                if($comment_key == 4) {
                    $unlocked_next_achievements['next_available_comments_achievement']= $comment->number_of_comments .' '.$comment->title;
                    break;
                }
            }
            else
            $unlocked_next_achievements['next_available_comments_achievement'] = '';
        }

        return $unlocked_next_achievements;
    }

    public function unlocked_lessons_achievements ($user, $total_lessons_watched) {
        $unlocked_achievements = [];
        $unlocked_achievements['total_lessons_watched'] = $total_lessons_watched;

        
        $lessons_watched_achievements = LessonsWatchedAchievement::all();

        foreach ($lessons_watched_achievements as $lesson_key => $lesson) {

            if(($lesson->number_of_lessons == $total_lessons_watched) &&  ($total_lessons_watched == 1)) {
                if($lesson_key == 0) {
                    $unlocked_achievements['lessons_watched_achievement']= $lesson->title;
                    break;
                }
            }
            elseif(($lesson->number_of_lessons == $total_lessons_watched) && ($total_lessons_watched == 5)) {
                if($lesson_key == 1) {
                    $unlocked_achievements['lessons_watched_achievement']= $lesson->number_of_lessons .' '.$lesson->title;
                    break;
                }
            }
            elseif(($lesson->number_of_lessons == $total_lessons_watched) && ($total_lessons_watched == 10)) {
                if($lesson_key == 2) {
                    $unlocked_achievements['lessons_watched_achievement']= $lesson->number_of_lessons .' '.$lesson->title;
                    break;
                }
            }
            elseif(($lesson->number_of_lessons == $total_lessons_watched) && ($total_lessons_watched == 25)) {
                if($lesson_key == 3) {
                    $unlocked_achievements['lessons_watched_achievement']= $lesson->number_of_lessons .' '.$lesson->title;
                    break;
                }
            }
            elseif(($lesson->number_of_lessons == $total_lessons_watched) && ($total_lessons_watched == 50)) {
                if($lesson_key == 4) {
                    $unlocked_achievements['lessons_watched_achievement']= $lesson->number_of_lessons .' '.$lesson->title;
                    break;
                }
            }
           
            $unlocked_achievements['lessons_watched_achievement'] = '';
        }

        return $unlocked_achievements;

    }
    public function next_available_lessons_achievement ($user, $total_lessons_watched) {
        $unlocked_achievements = [];
        $unlocked_achievements['total_lessons_watched'] = $total_lessons_watched;

        
        $lessons_watched_achievements = LessonsWatchedAchievement::all();

        foreach ($lessons_watched_achievements as $lesson_key => $lesson) {

            if(($lesson->number_of_lessons !== $total_lessons_watched) &&  ($total_lessons_watched == 0)) {
                if($lesson_key == 0) {
                    $unlocked_achievements['next_available_lessons_achievement']= $lesson->title;
                    break;
                }
            }
            elseif(($lesson->number_of_lessons !== $total_lessons_watched) && (($total_lessons_watched > 1) && ($total_lessons_watched < 5))) {
                if($lesson_key == 1) {
                    $unlocked_achievements['next_available_lessons_achievement']= $lesson->number_of_lessons .' '.$lesson->title;
                    break;
                }
            }
            elseif(($lesson->number_of_lessons !== $total_lessons_watched) && (($total_lessons_watched > 5) && ($total_lessons_watched < 10))) {
                if($$lesson_key == 2) {
                    $unlocked_achievements['next_available_lessons_achievement']= $lesson->number_of_lessons .' '.$lesson->title;
                    break;
                }
            }
            elseif(($lesson->number_of_lessons == $total_lessons_watched) && (($total_lessons_watched > 10) && ($total_lessons_watched < 25))) {
                if($lesson_key == 3) {
                    $unlocked_achievements['next_available_lessons_achievement']= $lesson->number_of_lessons .' '.$lesson->title;
                    break;
                }
            }
            elseif(($lesson->number_of_lessons == $total_lessons_watched) && (($total_lessons_watched > 25) && ($total_lessons_watched < 50))) {
                if($$lesson_key == 4) {
                    $unlocked_achievements['lessons_watched_achievement']= $lesson->number_of_lessons .' '.$lesson->title;
                    break;
                }
            }
           
            $unlocked_achievements['lessons_watched_achievement'] = '';
        }

        return $unlocked_achievements;

    }
}
