<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart_items = Cart::where('user_id', session('user_id'))->get();
        $orders = Order::where('user_id', session('user_id'))->get();
        $orders_items = Order_Product::whereHas('order', function ($query) {
            $query->where('user_id', session('user_id'));})->get();
        return view('carts.index' , compact('cart_items' , 'orders' ,'orders_items'));
    }

    public function rcart($product_id)
    {
        $user_id = session('user_id');
        Cart::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        // return redirect()->route('cart.index')->with('success', 'Removed from cart successfully');
       return redirect()->route('cart.index');
    }

    // public function rcart($product_id)
    // {
    //     $user_id = session('user_id');

    //     try {
    //         Cart::where('user_id', $user_id)->where('product_id', $product_id)->delete();

    //         return response()->json(['success' => true]);
    //     } catch (\Exception $e) {
    //         return response()->json(['success' => false]);
    //     }
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
