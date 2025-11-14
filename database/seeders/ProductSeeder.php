<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubCategory;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subCategories = SubCategory::all();

        foreach ($subCategories as $subCategory) {
            Product::factory()->count(6)->create([
                'sub_category_id' => $subCategory->id,
                'category_id' => $subCategory->category_id,
            ]);
        }
    }
}
