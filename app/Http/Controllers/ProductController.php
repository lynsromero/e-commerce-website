<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductValidation;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        $products = Product::all();
        return view('products.list', compact('products'));
    }
    public function create()
    {
        $cats = Category::all();
        $Subcats = SubCategory::all();
        return view('products.create', compact('cats', 'Subcats'));
    }

    public function store(ProductValidation $request)
    {
        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $img_name = time() . rand(100000, 1000000) . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images', $img_name, 'public');
            $product->image = 'storage/images/' . $img_name;
        }

        $product->save();

        return redirect()->route('products.list');
    }

    public function edit($id)
    {
        $product = Product::find($id);
        $cats = Category::all();
        $Subcats = SubCategory::all();
        return view('products.edit', compact('product', 'cats', 'Subcats'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->title = $request->title;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $image = $request->file('image');
        if ($image) {
            if ($product->image && file_exists($product->image)) {
                unlink($product->image);
            }
            $img_name = time() . rand(10000, 100000) . $image->getClientOriginalName();
            $image->storeAs('images', $img_name, 'public');
            $img_name = 'storage/images/' . $img_name;
            $product->image = $img_name;
        }
        $product->save();
        return redirect()->route('products.list')->with('success', 'Product updated successfully.');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect()->route('products.list')->with('success', 'Product Deleted successfully.');
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        $related_products = Product::where('category_id', $product->category_id)->where('id', '!=', $id)->limit(4)->get();
        $catsCount = Category::withCount('products')->get();

        $data = [
            'product' => $product,
            'related_products' => $related_products,
            'cats' => $catsCount,
            'sub_cat' => SubCategory::all(),
        ];

        return view('product-detail')->with($data);
    }
}
