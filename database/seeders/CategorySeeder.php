<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run(): void
{
    // Define subcategori
    $categories = [
        'Electronics' => ['Mobile', 'Laptop', 'Washing Machine', 'Computer'],
        'Clothing'    => ['Mens', 'Women', 'Children'],
    ];

    foreach ($categories as $categoryName => $subcategories) {
        // Find or create the main category
        $category = Category::firstOrCreate(['name' => $categoryName]);

        // Loop through and create subcategories
        foreach ($subcategories as $subName) {
            SubCategory::firstOrCreate([
                'name'        => $subName,
                'category_id' => $category->id,
            ]);
        }
    }
}

}
