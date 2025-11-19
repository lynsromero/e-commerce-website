<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request; 


class HomeController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy('title', 'asc')->paginate(4);

        if ($request->ajax() &&  $request->action == "search-product") {
            $products = Product::where('sub_category_id', $request->sub_cat_id)->paginate(4);
        }
        $data = [
            'sub_cats' => SubCategory::all(),
            'products' => $products,
            'product_pg' => Product::all(),
        ];

        if ($request->ajax() &&  $request->action == "search-product") {
            return view('front-product')->with($data);
        }

        return view('index')->with($data);
    }
public function shop(Request $request)
{
    $catsCount = Category::withCount('products')->get();



    $query = Product::orderBy('id', 'desc');

    if ($request->sub_cat_id) {
        $query->where('sub_category_id', $request->sub_cat_id);
    }

    if ($request->cat_id) {
        $query->where('category_id', $request->cat_id);
    }

    if ($request->range) {
        $query->where('price', '<=', $request->range);
    }

    
    $products = $query->paginate(9);

    $data = [
        'sub_cats' => SubCategory::all(),
        'products' => $products,
        'cats' => $catsCount,
    ];

    
    if ($request->ajax()) {
        return view('shop-products')->with($data);
    }

    return view('shop')->with($data);
}

};
