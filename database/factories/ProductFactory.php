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

        $imageFiles = [
            'best-product-1.jpg', 'best-product-2.jpg', 'best-product-3.jpg', 'best-product-4.jpg', 'best-product-5.jpg', 'best-product-6.jpg',
            'fruite-item-1.jpg', 'fruite-item-2.jpg', 'fruite-item-3.jpg', 'fruite-item-4.jpg', 'fruite-item-5.jpg', 'fruite-item-6.jpg',
            'vegetable-item-1.jpg', 'vegetable-item-2.jpg', 'vegetable-item-3.png', 'vegetable-item-4.jpg', 'vegetable-item-5.jpg', 'vegetable-item-6.jpg',
        ];
        $randomImage = $imageFiles[array_rand($imageFiles)];

        return [
            'title' => $this->faker->sentence(3),
            'price' => $this->faker->randomFloat(2, 10, 1000),
            'discount_price' => $this->faker->optional()->randomFloat(2, 5, 500),
            'category_id' => $category->id,
            'sub_category_id' => $subCategory->id,
            'description' => $this->faker->paragraph,
            'image' => 'storage/' . $randomImage,
        ];
    }
}
