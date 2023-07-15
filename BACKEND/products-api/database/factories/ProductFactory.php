<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           'company_id' => Company::all()->random()->id,
           'user_id' => User::all()->random()->id,
           'name' => $this->faker->name(),
           'category' => $this->faker->lastName(),
           'quantity' => $this->faker->randomNumber(1,100),
           'unitary_price' => $this->faker->randomFloat(2,5,99000),
        ];
    }
}
