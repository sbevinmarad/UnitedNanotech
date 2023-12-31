<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName                                  ,
            'email' => $this->faker->unique()->safeEmail,
            'phone'=> $this->faker->phoneNumber,
            'email_verified_at' => now(),
            'password' => '11111111', // password
            'user_id' => Str::random(6),
            'remember_token' => Str::random(10),
        ];
    }
}
