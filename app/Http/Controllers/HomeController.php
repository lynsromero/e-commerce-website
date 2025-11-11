<?php

namespace App\Http\Controllers;

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
            'product_pg' =>Product::all(),
        ];

        if ($request->ajax() &&  $request->action == "search-product") {            
            return view('front-product')->with($data);
        }

        return view('index')->with($data);
    }
}
;