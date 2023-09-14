<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/category.css')}}">
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
        <form action="{{ route('category.create') }}">
            <button class="mybtn-lrg">Add New Category</button>
        </form>
    </div>

    <div class="tbl-cont">
        <table class="mytbl">
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th colspan="2">Actions</th>
            </tr>

        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td>{{ $category->name }}</td>

                <td>
                    <form action="{{route('category.update' , $category->id)}}">
                        <button class="mybtn">Update</button>
                    </form>
                </td>

                <td>
                    <form action="{{route('category.destroy' , $category->id)}}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="mybtn">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
    <br>



</body>
</html>

