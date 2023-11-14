<?php

namespace Database\Factories;

use app\Data\Enums\MediaTypeEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Media>
 */
class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'src' => fake()->imageUrl,
            'type' => fake()->randomElement(MediaTypeEnum::toArray()),
            'mediaable_type' => null,
            'mediaable_id' => null
        ];
    }
}
