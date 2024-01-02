<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Question;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Answer>
 */
class AnswerFactory extends Factory
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
            'content' => $this->faker->paragraph,
            'isanonymous' => $this->faker->boolean,
            'user_id' => User::all()->random()->id,
            'question_id' => Question::all()->random()->id,
            'created_at' => $randomDate,
            'updated_at' => $randomDate,
        ];
    }
}
