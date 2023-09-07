<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Order_Product;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::where('user_id', session('user_id'))->get();
        $orders_items = Order_Product::whereHas('order', function ($query) {
            $query->where('user_id', session('user_id'));})->get();
        return view('orders.index' , compact('orders' ,'orders_items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

     public function store(Request $request)
{
    $selectedItems = $request->input('selected_items');

    if (empty($selectedItems)) {
        // No items selected, redirect back with an error message
        return redirect()->back()->with('error', 'Please select at least one item to order.');
    }

    // Create a new order
    $order = new Order();
    $order->user_id = auth()->id(); // Assuming you have authentication set up
    $order->total_amount = 0; // You can update this later based on the items
    $order->shipping = 0; // 5% shipping cost, adjust as needed
    $order->save();

    // Get the selected items and quantities from the form
    $selectedItems = $request->input('selected_items');
    $quantities = $request->input('quantities');

    // Calculate the total amount for the order
    $totalAmount = 0;

    foreach ($selectedItems as $selectedItem) {
        // Create an order item for each selected item
        $orderItem = new Order_Product();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $selectedItem;
        $orderItem->quantity = $quantities[$selectedItem]; // Get the corresponding quantity
        $orderItem->save();

        // Calculate the total amount for the order based on each item's price and quantity
        $product = Product::find($selectedItem);
        $totalAmount += $product->sell_price * $quantities[$selectedItem];

        // Decrease the product's quantity in the products table
        $product->quantity -= $quantities[$selectedItem];
        $product->save();

        // Remove the item from the cart
        $cartItem = Cart::where('user_id', auth()->id())
            ->where('product_id', $selectedItem)
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }
    }

    // Update the total amount of the order
    $order->total_amount = $totalAmount;
    $order->shipping = 0.05 * $order->total_amount; // 5% shipping cost, adjust as needed

    $order->save();

    // Redirect to a success page or do any other actions as needed
    return redirect()->route('cart.index')->with('success', 'Order placed successfully');
}

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
