<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randomDate = $this->faker->dateTimeBetween("-1 year");
        return [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'isanonymous' => $this->faker->boolean,
            'viewcount' => $this->faker->numberBetween(0, 100),
            'user_id' => User::all()->random()->id,
            'created_at' => $randomDate,
            'updated_at' => $randomDate,
        ];
    }
}
