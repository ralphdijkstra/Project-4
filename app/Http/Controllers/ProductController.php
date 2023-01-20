<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('product.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:products', 'max:20'],
            'description' => ['required', 'max:234'],
            'image' => ['required', 'max:234'],
            'price' => ['required', 'max:234'],

        ]);
    
        // Product::create($request->only(['name', 'description','image','price']), 1);

        $product = new Product();
        $product->name = $request->name;
        $product->description = $request->name;
        $product->image = $request->image;
        $product->price = $request->price;
        $product->category_id = 1;
        $product->save();
    
        return redirect()->route('products.index');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('product.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        
        $request->validate([
            'name' => ['required', Rule::unique('products')->ignore($product), 'max:20'],
            'description' => ['required', 'max:234'],
            'img' => [ 'max:234'],
            'price' => ['required', 'max:234'],

        ]);
    
        $product->update($request->only(['name', 'description', 'image', 'price']));
        return redirect()->route('products.index')->with('success', 'Product updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    public function delete($id)
    {
        $product = Product::find($id);
        return view('product.delete')->with('product', $product);
    }
}
