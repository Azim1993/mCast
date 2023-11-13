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
        Schema::create('timeline_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timeline_id')
                ->constrained()
                ->references('id')->on('timelines')
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained()
                ->references('id')->on('users')
                ->cascadeOnDelete();
            $table->string('comment');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeline_comments');
    }
};
