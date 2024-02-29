<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //index products with paginate 5
        $products = Product::paginate(5);
        return view('pages.product.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $filename ="";
        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->storeAs('public/products', $filename);
        }
        $product = new \App\Models\Product;
        $product->name = $request->name;
        $product->price = (int) $request->price;
        $product->stock = (int) $request->stock;
        $product->category_id = $request->category_id;
        $product->image = $filename;
        $product->save();

        return redirect()->route('product.index');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($product)
    {
        $categories = Category::all();
        $products = Product::findOrFail($product);
        return view('pages.product.edit', compact('products', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $product)
    {
        //dd the request
        //dd($request->all());
        $products = Product::findOrFail($product);

        if ($request->hasFile('imageFile')) {
            $filename = time() . '.' . $request->imageFile->extension();
            $request->imageFile->storeAs('public/products', $filename);
            //merge image to request
            $request->merge(['image' => $filename]);
        }

        $products->update($request->all());
        return redirect()->route('product.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success', 'Product Deleted Successfully');
    }
}
