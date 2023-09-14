<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/product.css') }}">
    <script src="{{ asset('js/darkmode.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/search.js') }}"></script>
    <title>Just Click</title>
</head>
<body>
    @include('includes.header')

    <form action="{{ route('products.search') }}" method="GET">
        <div class="search-container">
            <input type="text" id="search" name="query" placeholder="Search products...">
            <button id="search-button" type="submit">&#128269;</button>
        </div>
        </form>

    @if ($products->isEmpty())
        <p>No results found.</p>
    @endif

        {{-- <div id="search-results" class="products-cont-no-mar"></div> --}}

    {{-- Products Container --}}
    {{-- <div id="product-display-container" class="products-cont-no-mar"> --}}
    <div id="product-display-container" class="products-cont">
        @foreach ($products as $product)
            <div class="item-card">
                <img src="/images/{{ $product->image }}" alt="" class="card-img">
                {{-- <img src="/images/latte.jpg" alt="" class="card-img"> --}}
                <div class="card-content">
                    <p class="card-title">{{ $product->name }}</p>
                    <p class="card-desc">{{ $product->desc }}</p>
                    <div class="price-and-btn">
                        @if ($product->quantity > 0)
                            @if ($cart_items->contains('product_id', $product->id))
                                <p class="card-price-add">${{ $product->sell_price }}</p>
                                <form action="{{ route('products.rcart', $product->id) }}" method="POST">
                                    @method('PUT')
                                    @csrf
                                    <button class="mybtn-add">Added to Cart</button>
                                </form>
                            @else
                                <p class="card-price">${{ $product->sell_price }}</p>
                                <form action="{{ route('products.cart', $product->id) }}" method="POST">
                                    @csrf
                                    <button class="mybtn">Add to Cart</button>
                                </form>
                            @endif
                        @else
                            <p class="card-price-err">${{ $product->sell_price }}</p>
                            <p class="err">Out of Stock</p>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</body>
</html>
