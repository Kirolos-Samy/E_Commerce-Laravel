<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    <script src="{{ asset('js/darkmode.js') }}" defer></script>
    <script src="{{ asset('js/profile.js') }}" defer></script>
    <title>Just Click</title>
</head>
<body>

    @if(session('role_id') == 2)
        @include('includes.header')
    @else
        @include('includes.aheader')
    @endif

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

{{-- Profile Form --}}
<form action="{{ route('account.update', $user->id) }}" method="post" id="profile-form">
    @method('PUT')
    @csrf
    <div class="form-wrapper">

        <div class="fieldset-container">

            <fieldset class="fieldset">

                <!-- Profile form inputs -->
                <label for="first-name" class="title">Profile</label>
                <br> <br>

                <div class="input-group">
                    <label for="first-name" class="input-label">First Name</label>
                    <input type="text" id="first-name" name="first_name" class="input-group__input" value="{{ $user->first_name }}" required>
                </div>

                <div class="input-group">
                    <label for="last-name" class="input-label">Last Name</label>
                    <input type="text" id="last-name" name="last_name" class="input-group__input" value="{{ $user->last_name }}" required>
                </div>

                <div class="input-group">
                    <label for="email" class="input-label">Email</label>
                    <input type="email" id="email" name="email" class="input-group__input" value="{{ $user->email }}" readonly>
                </div>

                <div class="input-group">
                    <label for="password" class="input-label">Old Password</label>
                    <input type="password" name="password" id="password" class="input-group__input" value="" required>
                </div>

                <div class="input-group">
                    <label for="new_pass" class="input-label">New Password</label>
                    <input type="password" name="new_pass" id="new_pass" class="input-group__input" required>
                    <span id="togglePassword" class="eye-icon">&#128065;</span>
                </div>

                <button type="submit" id="update-button" class="mybtn">Update</button>
                <br>

            </fieldset>
        </div>
    </div>
</form>
<div class="logout">
    <form action="{{ route('account.logout') }}" method="POST">
        @csrf
        <div class="logout-btn">
            <button class="mybtn" type="submit">Logout</button>
        </div>
    </form>
</div>

</body>
</html>
