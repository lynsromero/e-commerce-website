<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'title',
        'price',
        'discount_price',
        'category_id',
        'sub_category_id',
        'description',
        'image',
    ];

    public function img()
    {
        if ($this->image) {
            return '<img src="' . asset($this->image) . '" alt="" width = "80px" , height = "80px" >';
        }
    }

    public function category(){
        return $this->belongsTo(Category::class , 'category_id');
    }
    public function subcategory(){
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
