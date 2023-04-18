<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->fake()->title,
            'slug' => $this->fake()->slug,
            'summary' => $this->fake()->sentences(3, true),
            'photo' => $this->fake()->imageUrl(100, 100),
            'is_parent' => $this->fake()->randomElement([true, false]),
            'status' => $this->fake()->randomElement(['active', 'inactive']),
            'parent_id' => $this->fake()->randomElement(Category::pluck('id')->toArray());
            

        ];
    }
}
