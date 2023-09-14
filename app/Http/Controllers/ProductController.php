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
        $products = Product::where('active', 1)->get(); // 1 represents active
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

        $request->validate([
            'image2' => 'image|mimes:jpeg,png,jpg,gif'
        ]);

        // dd($request);

        // Split the string by dot character (.)
        // $parts = explode(".", $request->image);

        // Get the last part of the array, which is the file extension
        // $ext = end($parts);

        $imageName = time().'.'.$request->image2->extension();
        // $imageName = time().'.'.$ext;

        // $imageName = "aa";

        // dd($imageName);

        $request->image2->move(public_path('images'), $imageName);



        Product::create([
            'name' => $request->name,
            'desc' => $request->desc,
            'cost_price' => $request->cost_price,
            'sell_price' => $request->sell_price,
            'quantity' => $request->quantity,
            'tags' => $request->tags,
            'image' => $imageName,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('admin.index');

        // Product::create($request->all());
        // return redirect()->route('admin.index');
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
    public function deactivate($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.index')->with('error', 'Product not found.');
        }

        // Set the product as inactive (0)
        $product->active = 0;
        $product->save();

        return redirect()->route('admin.index')->with('success', 'Product deactivated successfully.');
    }

    public function activate($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('admin.index')->with('error', 'Product not found.');
        }

        // Set the product as inactive (0)
        $product->active = 1;
        $product->save();

        return redirect()->route('admin.index')->with('success', 'Product activated successfully.');
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

    public function search(Request $request)
    {
        $query = $request->input('query');

        // Perform a search query on your products table based on the user's input
        $products = Product::where(function ($productQuery) use ($query) {
            $productQuery->where('name', 'LIKE', "%$query%")
                ->orWhere('tags', 'LIKE', "%$query%");
        })
        ->where('active', 1) // 1 represents active
        ->get();

        $cart_items = Cart::where('user_id', session('user_id'))->get();


        // Pass the search results to a view
        return view('products.index', compact('products', 'cart_items' , 'query'));
    }


}
