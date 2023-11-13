<?php

namespace Database\Factories;

use App\Enums\PreviewPrivacyTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Timeline>
 */
class TimelineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => null,
            'content' => fake()->text(),
            'preview_privacy' => fake()->randomElement(PreviewPrivacyTypeEnum::toArray()),
            'total_reaction' => 0
        ];
    }
}
