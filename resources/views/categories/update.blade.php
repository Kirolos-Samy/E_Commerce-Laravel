<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/categoryy.css')}}">
    <script src="{{asset('js/darkmode.js')}}" defer></script>
    <title>Just Click</title>
</head>
<body>

    @include('includes.aheader')

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

    <div class="products-cont">
        <h2 style="text-align: center">Edit Category : {{$category->name}}</h2>
    </div>
    <div class="products-cont-no-mar">
    <form action="{{route('category.edit',$category->id)}}" method="post">
        @method('PUT')
        @csrf

        <div class="input-group">
            <input type="text" id="name" name="name" class="input-group__input" value="{{$category->name}}" required>
            <label for="name" class="input-group__label">Category Name</label>
        </div>
        <br>

        <button class="mybtn">Update</button>
    </form>
    <br>
    {{-- <form action="{{route('category.index')}}">
        <button>Back</button>
    </form> --}}

</div>
</body>
</html>
