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
        Schema::create('timeline_media', function (Blueprint $table) {
            $table->id();
            $table->foreignId('timeline_id')
                ->constrained()
                ->references('id')->on('timelines')
                ->cascadeOnDelete();
            $table->foreignId('media_id')
                ->constrained()
                ->references('id')->on('media')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timeline_media');
    }
};
