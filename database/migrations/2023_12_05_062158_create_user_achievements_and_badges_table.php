<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_achievements_and_badges', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('comments_achievement')->nullable();
            $table->string('lessons_achievement')->nullable();
            $table->string('current_badge')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_achievements_and_badges');
    }
};
