<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        $cart_items = Cart::where('user_id', session('user_id'))->get();
        return view('products.index' , compact('products', 'cart_items'));
    }

    public function cart($product_id)
    {
        if(session('user_id')){
            Cart::create([
                'user_id' => session('user_id'),
                'product_id' => $product_id,
                'quantity' => 1
            ]);
            return redirect()->route('products.index')->with('success', 'Added to cart successfully');
        } else {
            return redirect()->route('account.index')->with('error', 'You must login first');
        }
    }

    public function rcart($product_id)
    {
        $user_id = session('user_id');
        Cart::where('user_id', $user_id)->where('product_id', $product_id)->delete();
        return redirect()->route('products.index')->with('success', 'Removed from cart successfully');
    }

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
        $product = Product::find($id);
        return view('products.update', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product= Product::find($id);
        $product->update([
            'name' => $request->name ,
            'desc' => $request->desc ,
            'cost_price' => $request->cost_price ,
            'sell_price' => $request->sell_price ,
            'quantity' => $request->quantity ,
            'tags' => $request->tags ,
            'category_id' => $request->category_id ,
        ]);
        return redirect()->route('admin.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    // public function search(Request $request)
    // {
    //     $query = $request->input('q');

    //     // Perform a database query to search for products based on the query
    //     $products = Product::where('name', 'like', "%$query%")
    //         // ->orWhere('desc', 'like', "%$query%")
    //         ->get();

    //     return response()->json($products);
    // }

}
