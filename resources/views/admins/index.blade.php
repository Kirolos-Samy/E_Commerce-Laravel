<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/admin.css')}}">
    <script src="{{asset('js/darkmode.js')}}" defer></script>
    {{-- <script src="{{ asset('js/home.js') }}" defer></script> --}}
    <title>Just Click</title>
</head>
<body>
    @include('includes.aheader')

    {{-- @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger shake">
            {{ session('error') }}
        </div>
    @endif --}}

    <div class="products-cont">
        <form action="{{ route('product.create') }}">
            <button class="mybtn">Add New Product</button>
        </form>
    </div>

    <div class="products-cont-no-mar">
        @foreach ($products as $product)
            <div class="item-card">
                <img src="images/{{ $product->image }}" alt="" class="card-img">
                <div class="card-content">
                    <p class="card-title">{{ $product->name }}</p>
                    <p class="card-desc">{{ $product->desc }}</p>
                    <div class="price-and-btn">
                        <p class="desc">Category : {{$product->category->name}}</p>
                        <p class="desc">Stock : {{$product->quantity}}</p>
                    </div>
                    <div class="price-and-btn">
                        <p class="desc">Cost Price : ${{ $product->cost_price }}</p>
                        <p class="desc">Sell Price : ${{ $product->sell_price }}</p>
                    </div>
                    <div class="center">
                        <form action="{{ route('product.edit', $product->id) }}">
                                    <button class="mybtn">Edit</button>
                        </form>
                        {{-- @if ($product->where('active', 1)) --}}
                        @if ($product->active)
                            <form action="{{ route('product.deactivate', $product->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="mybtn-err">Deactivate</button>
                            </form>
                        @else
                            <form action="{{ route('product.activate', $product->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="mybtn-add">Activate</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>






</body>
</html>
