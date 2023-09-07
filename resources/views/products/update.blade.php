<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/update.css') }}">
    <script src="{{ asset('js/darkmode.js') }}" defer></script>
    <title>Just Click - Update Product</title>
</head>
<body>
    @include('includes.aheader')

    <h2 class="title">Update Product</h2>

    <div class="products-cont">

        <!-- Update Product Form -->
        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Product Name -->
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="name" value="{{ $product->name }}" required>
            </div>

            <!-- Product Description -->
            <div class="form-group">
                <label for="product_description">Product Description</label>
                <textarea id="product_description" name="desc" required>{{ $product->desc }}</textarea>
            </div>

            <!-- Cost Price -->
            <div class="form-group">
                <label for="cost_price">Cost Price</label>
                <input type="number" id="cost_price" name="cost_price" value="{{ $product->cost_price }}" required>
            </div>

            <!-- Sell Price -->
            <div class="form-group">
                <label for="sell_price">Sell Price</label>
                <input type="number" id="sell_price" name="sell_price" value="{{ $product->sell_price }}" required>
            </div>

            <!-- Product Quantity -->
            <div class="form-group">
                <label for="qty">Stock Quantity</label>
                <input type="number" id="qty" name="quantity" value="{{ $product->quantity }}" required>
            </div>

            <!-- Product Tags -->
            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" id="tags" name="tags" value="{{ $product->tags }}" required>
            </div>

            <!-- Category ID -->
            <div class="form-group">
                <label for="cat_id">Category ID</label>
                <input type="number" id="cat_id" name="category_id" value="{{ $product->category_id }}" required>
            </div>

            <!-- Category Name -->
            <div class="form-group">
                <label for="cat_name">Category Name</label>
                <input type="text" id="cat_name" value="{{ $product->category->name }}" readonly>
            </div>

            <!-- Submit Button -->
            <button type="submit">Update Product</button>
        </form>
    </div>
</body>
</html>
