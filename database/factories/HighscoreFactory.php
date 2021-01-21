<?php

namespace Database\Factories;

use App\Models\Highscore;
use Illuminate\Database\Eloquent\Factories\Factory;

class HighscoreFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Highscore::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'game_id' => $this->faker->numberBetween(1,1),
            'score' => $this->faker->numberBetween(20,300),
        ];
    }
}
