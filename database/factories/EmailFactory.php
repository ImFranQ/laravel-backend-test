<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Email;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Email::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'email' => $this->faker->safeEmail,
            'subject' => $this->faker->text($maxNbChars = 20),
            'body' => $this->faker->text($maxNbChars = 500),
            'status' => $this->faker->randomElement(['pending', 'sent'])
        ];
    }
}
