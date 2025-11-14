<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\SubCategory;

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
        $subCategory = SubCategory::inRandomOrder()->first();
        $category = Category::find($subCategory->category_id);

        return [
            'title' => $this->faker->sentence(3),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'discount_price' => $this->faker->optional()->randomFloat(2, 5, 500),
            'category_id' => $category->id,
            'sub_category_id' => $subCategory->id,
            'description' => $this->faker->paragraph,
            'image' => $this->faker->imageUrl(640, 480, 'products', true),
        ];
    }
}
