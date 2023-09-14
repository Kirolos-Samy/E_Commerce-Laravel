<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/update.css') }}">
    <script src="{{ asset('js/darkmode.js') }}" defer></script>
    <title>Just Click</title>
</head>
<body>
    @include('includes.aheader')

    <h2 class="title">Add Product</h2>

    <div class="products-cont">

        <!-- Add Product Form -->
        <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Product Name -->
            <div class="form-group">
                <label for="product_name">Product Name</label>
                <input type="text" id="product_name" name="name" required>
            </div>

            <!-- Product Description -->
            <div class="form-group">
                <label for="product_description">Product Description</label>
                <textarea id="product_description" name="desc" required></textarea>
            </div>

            <!-- Cost Price -->
            <div class="form-group">
                <label for="cost_price">Cost Price</label>
                <input type="number" id="cost_price" name="cost_price" required>
            </div>

            <!-- Sell Price -->
            <div class="form-group">
                <label for="sell_price">Sell Price</label>
                <input type="number" id="sell_price" name="sell_price" required>
            </div>

            <!-- Product Quantity -->
            <div class="form-group">
                <label for="qty">Stock Quantity</label>
                <input type="number" id="qty" name="quantity" required>
            </div>

            <!-- Product Tags -->
            <div class="form-group">
                <label for="tags">Tags</label>
                <input type="text" id="tags" name="tags" required>
            </div>

            <!-- Category ID -->
            <div class="form-group">
                <label for="cat_id">Category ID</label>
                <input type="number" id="cat_id" name="category_id" required>
            </div>

            <!-- Product Image -->
            <label for="image" class="upload-btn">
                Add Image
                <input type="file" id="image" name="image2" style="display: none;">
            </label>

            <!-- Category Name -->
            {{-- <div class="form-group">
                <label for="cat_name">Category Name</label>
                <input type="text" id="cat_name" readonly>
            </div> --}}

            <!-- Submit Button -->
            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>
