<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/order.css')}}">
    <script src="{{asset('js/darkmode.js')}}" defer></script>
    <script src="{{ asset('js/order.js') }}" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Just Click</title>
</head>
<body>
    @include('includes.header')

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shake">
            {{ session('error') }}
        </div>
    @endif


<!-- My Cart Section -->
<section class="my-cart">
    <h2>My Cart</h2>

    <form action="{{ route('orders.add') }}" id="add-form" method="POST">
        @csrf
        <div class="products-cont">
            @foreach ($cart_items as $item)
            <div class="item-card">
                @if ($item->product->quantity > 0)
                    <div class="checkbox-container">
                        <input type="checkbox" name="selected_items[]" value="{{ $item->product->id }}" id="myCheckbox{{ $item->product->id }}" class="checkbox-input">
                        <label for="myCheckbox{{ $item->product->id }}" class="checkbox-label"></label>
                    </div>
                @endif
                <img src="images/{{ $item->product->image }}" alt="" class="card-img">
                <div class="card-content">
                    <p class="card-title">{{ $item->product->name }}</p>
                    <p class="card-desc">{{ $item->product->desc }}</p>
                    <div class="price-and-btn">
                        @if ($item->product->quantity > 0)
                            <p class="card-price-add">${{ $item->product->sell_price }}</p>
                            <div class="quantity-control">
                                <button type="button" class="quantity-btn quantity-decrement">-</button>
                                <input type="number" name="quantities[{{ $item->product->id }}]" class="quantity-input" value="1" min="1" max="{{ $item->product->quantity }}" readonly>
                                <button type="button" class="quantity-btn quantity-increment">+</button>
                            </div>
                        @else
                            <p class="card-price-err">${{ $item->product->sell_price }}</p>
                            <p class="err">Out of Stock</p>
                        @endif
                    </div>
                    {{-- <form action="{{ route('cart.rcart', $item->product_id) }}" id="rem-form" method="POST">
                        @method('PUT')
                        @csrf
                        <button class="mybtn-err">Remove</button>
                    </form> --}}
                </div>
            </div>
            @endforeach
        </div>

        <div class="center">
            <button type="submit" class="mybtn-add">Order</button>
        </div>
    </form>
</section>
