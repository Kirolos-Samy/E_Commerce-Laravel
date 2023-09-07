<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/order.css')}}">
    <script src="{{asset('js/darkmode.js')}}" defer></script>
    <script src="{{ asset('js/order.js') }}" defer></script>
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

{{-- My Orders Table --}}
<section>

        <div class="tbl-cont">
            <table class="mytbl">
                <thead>
                    <th>Order ID</th>
                    <th>Product Image</th>
                    <th>Product Price</th>
                    <th>Quantity</th>
                    <th>SubTotal</th>
                    <th>Total Price</th>
                </thead>
                @php
                    $currentIndex = 0; // Initialize the current index
                @endphp
                @foreach($orders as $order)
                    @php
                        $rowspan = count($order->orders_products);
                    @endphp
                    @foreach($order->orders_products as $product)
                        <tr>
                            @if ($loop->first)
                                <td rowspan="{{ $rowspan }}">{{$order->id}}</td>
                            @endif
                            <td>
                                <img src="images/{{ $product->product->image }}" width="50px" height="50px" alt="">
                            </td>
                            <td>${{$product->product->sell_price}}</td>
                            <td>{{$product->quantity}}</td>
                            <td>${{$product->product->sell_price * $product->quantity}}</td>
                            @if ($loop->first)
                                <td rowspan="{{ $rowspan }}">${{ $order->total_amount }}</td>
                            @endif
                        </tr>
                    @endforeach
                    @php
                        $currentIndex++;
                    @endphp
                @endforeach
            </table>
        </div>

</section>

<!-- My Orders Section -->
<section class="my-orders">
    <h2>My Orders</h2>
        <div class="products-cont">
            @foreach ($orders_items as $oitem)
                    <div class="item-card">
                        <img src="images/{{ $oitem->product->image }}" alt="" class="card-img">
                        <div class="card-content">
                            <p class="card-title">{{ $oitem->product->name }}</p>
                            <p class="card-desc">{{ $oitem->product->desc }}</p>
                            <p class="card-title">Order Details : </p>
                            <div class="price-and-btn">
                                {{-- <p class="card-price-err">${{ $oitem->product->sell_price }}</p> --}}
                                <p class="card-desc">Order No : {{ $oitem->order_id }}</p>
                                <p class="card-desc">Qty : {{ $oitem->quantity }} * ${{ $oitem->product->sell_price }} =
                                    ${{$oitem->quantity * $oitem->product->sell_price}} </p>
                            </div>
                        </div>
                    </div>
            @endforeach
        </div>
</section>


</body>
</html>
