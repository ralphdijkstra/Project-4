<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatus;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user()->id;
        $orders = Order::where('user_id', $user)->orderby('created_at', 'DESC')->get();
        return view('order.index')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('order.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order = new Order();
        if (Auth::check()) {
            $user = Auth::user()->id;
            $order->user_id = $user;
        } else {
            $order->guest_name = $request->guest_name;
        }
        $order->address = $request->address;
        $order->postal_code = $request->postal_code;
        $order->city = $request->city;
        $order->status_id = 1;
        $order->save();

        foreach (session('cart') as $key => $value) {
            $product = Product::find($value['id']);
            $orderitem = new OrderItem();
            $orderitem->order_id = $order->id;
            $orderitem->product_id = $value['id'];
            $orderitem->size = $value['size'];
            $orderitem->quantity = $value['quantity'];
            $orderitem->price = $value['price'];
            foreach ($value['ingredients'] as $key => $ingredient) {
                $i = Ingredient::find($ingredient);
                $orderitem->ingredients = $orderitem->ingredients . " " . $i->id;
            }
            $orderitem->save();
        }

        session()->forget('cart');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ingredients = Ingredient::all();
        $order = Order::find($id);
        $orderitems = OrderItem::where('order_id', $id)->get();
        return view('order.show')->with('order', $order)->with('orderitems', $orderitems)->with('ingredients', $ingredients);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        $orderstatusses = OrderStatus::all();
        $orderitems = OrderItem::where('order_id', $id)->get();
        return view('order.edit')->with('order', $order)->with('orderitems', $orderitems)->with('orderstatusses', $orderstatusses);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->status_id  = $request->input('status');
        $order->update();
        return redirect('/orders/' . $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function manage()
    {
        $orders = Order::orderBy('created_at', 'DESC')->get();
        return view('order.manage')->with('orders', $orders);
    }
}
