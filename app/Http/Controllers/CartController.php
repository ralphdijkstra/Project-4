<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        session('cart')->forget($id);

        $collection = collect();

        foreach (session('cart') as $value) {
            $collection->push($value);
        }

        session()->put('cart', $collection);

        return redirect()->back()->with('success', 'Product removed from cart successfully!');
    }

    public function addToCart($id, Request $request)
    {
        $product = Product::find($id);
        if (!session()->has('cart')) {
            session()->put('cart', collect([]));
        }

        $new_product = [
            "id" => $product->id,
            "name" => $product->name,
            "quantity" => 1,
            "price" => $product->price,
            "size" => $request->size,
            "ingredients" => $request->ingredients,
        ];

        $collection = collect();

        foreach (session('cart') as $value) {
            if ($value['name'] == $new_product['name'] && $value['size'] == $new_product['size'] && $value['ingredients'] == $new_product['ingredients']) {
                $new_quantity = $value['quantity'] + 1;
                $collection->push(
                    [
                        "id" => $value['id'],
                        "name" => $value['name'],
                        "quantity" => $new_quantity,
                        "price" => $value['price'],
                        "size" => $value['size'],
                        "ingredients" => $value['ingredients'],
                    ]
                );

                session()->put('cart', $collection);

                return redirect()->back()->with('success', 'Product added to cart successfully!');
            } else {
                $collection->push(
                    [
                        "id" => $value['id'],
                        "name" => $value['name'],
                        "quantity" => $value['quantity'],
                        "price" => $value['price'],
                        "size" => $value['size'],
                        "ingredients" => $value['ingredients'],
                    ]
                );
            }
        }

        $collection->push($new_product);

        session()->put('cart', $collection);

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    public function refresh(Request $request)
    {
        $collection = collect();

        foreach (session('cart') as $key => $value) {
            if ($value['name'] == $request->name && $value['size'] == $request->size && $value['ingredients'] == $request->ingredients && $key != $request->id) {
                $collection->push(
                    [
                        "id" => $value['id'],
                        "name" => $value['name'],
                        "quantity" => $value['quantity'] + $request->quantity,
                        "price" => $value['price'],
                        "size" => $value['size'],
                        "ingredients" => $value['ingredients'],
                    ]
                );
                $x = 1;
            }
            else if ($key != $request->id) {
                $collection->push(
                    [
                        "id" => $value['id'],
                        "name" => $value['name'],
                        "quantity" => $value['quantity'],
                        "price" => $value['price'],
                        "size" => $value['size'],
                        "ingredients" => $value['ingredients'],
                    ]
                );
            } else {
                $collection->push(
                    [
                        "id" => $value['id'],
                        "name" => $value['name'],
                        "quantity" => $request->quantity,
                        "price" => $value['price'],
                        "size" => $request->size,
                        "ingredients" => $request->ingredients,
                    ]
                );
            }
        }

        if(isset($x)){
            $collection->forget($request->id);
        }

        session()->put('cart', $collection);

        return redirect()->back()->with('success', 'Product updated from cart successfully!');
    }
}
