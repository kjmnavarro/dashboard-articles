<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
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
            // 'image' => $this->faker->imageUrl(),
            'image' => $randURL,
            'title' => $this->faker->sentence,
            'link' => $this->faker->url,
            'date' => $this->faker->date,
            'content' => $this->faker->paragraph,
            'status' => $this->faker->randomElement(['For Edit', 'Published']),
            'writer_id' => User::factory(),
            'editor_id' => $this->faker->randomElement([Null, User::factory()]),
            'company_id' => Company::factory(),
        ];
    }
}
