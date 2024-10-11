<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Company>
 */
class CompanyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $randColor = substr(md5(rand()), 0, 6);
        $randURL = 'https://placehold.co/600x400/'.$randColor.'/FFF?text=Hello+World';

        return [
            // 'logo' => $this->faker->imageUrl(),
            'logo' => $randURL,
            'name' => $this->faker->company,
            'status' => $this->faker->randomElement(['Active', 'Inactive']),
        ];
    }
}
