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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('src');
            $table->enum('type', \App\Enums\MediaTypeEnum::toArray())->default(\App\Enums\MediaTypeEnum::IMAGE->value);
            $table->string('mediaable_type')->nullable();
            $table->unsignedBigInteger('mediaable_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
