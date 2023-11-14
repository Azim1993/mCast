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
        Schema::create('timelines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained()
                ->references('id')->on('users')
                ->cascadeOnDelete();

            $table->string('content');
            $table->enum('preview_privacy', \app\Data\Enums\PreviewPrivacyTypeEnum::toArray())->default(\app\Data\Enums\PreviewPrivacyTypeEnum::PUBLIC->value);
            $table->unsignedBigInteger('total_reaction')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('timelines');
    }
};
