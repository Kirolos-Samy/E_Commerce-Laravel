<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/account.css')}}">
    <script src="{{asset('js/darkmode.js')}}" defer></script>
    <script src="{{asset('js/account.js')}}" defer></script>
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

    {{-- dd(session('user_id')); --}}

    {{-- @if(session('user_id'))
        <div class="alert alert-success">
            {{ session('user_name') }}
        </div>
    @endif --}}
    {{-- console.log(session('user_id')); --}}


    <div class="form-wrapper">
        <div class="toggle-forms">
            <span id="login-link"></span>
            <span id="register-link"></span>
        </div>

        {{-- Login Form --}}

        <form action="{{route('account.login')}}" method="post" id="login-form" class="form">
            @csrf
            <div class="fieldset-container">

                <fieldset class="fieldset">
                    <!-- Login form inputs -->
                    <label for="" class="title">Login</label>
                    <br> <br>
                    <div class="input-group">
                        <input type="text" id="lemail" name="email" class="input-group__input"   required>
                        <label for="lemail" id="lemlabel" class="input-group__label">Email</label>
                    </div>
                    <br>
                    <div class="input-group">
                        <input type="password" name="password" id="lpassword" class="input-group__input" required>
                        <label for="lpassword" id="lpasslabel" class="input-group__label">Password</label>
                    </div>

                    <button type="submit" class="mybtn">Login</button>
                    <br>

                    <label for="register-link">Don't have an account ?</label>
                    <span id="register-link2" class="active">Register</span>
                </fieldset>
            </div>
        </form>

        {{-- Registeration Form --}}


        <form action="{{route('account.store')}}" method="post" id="register-form" class="form">
            @csrf
            <div class="fieldset-container">

                <fieldset class="fieldset">

                <label for="" class="title">Register</label>
                <br> <br>

                <div class="input-group">
                    <input type="text" id="first" name="first_name" class="input-group__input" required>
                    <label for="first" id="firstlabel" class="input-group__label">First Name</label>
                </div>
                <br>
                <div class="input-group">
                    <input type="text" id="last" name="last_name" class="input-group__input" required>
                    <label for="last" id="lastlabel" class="input-group__label">Last Name</label>
                </div>
                <br>
                <div class="input-group">
                    <input type="email" id="remail" name="email" class="input-group__input" required>
                    <label for="remail" id="emaillabel" class="input-group__label">Email</label>
                </div>
                <br>
                <div class="input-group">
                    <input type="password" name="password" id="rpassword" class="input-group__input" required>
                    <label for="rpassword" id="passlabel" class="input-group__label">Password</label>
                    <span id="togglePassword" class="eye-icon">&#128065;</span>
                </div>
                <br>
                <div class="input-group">
                    <input type="password" name="confirm" id="confirm" class="input-group__input" required>
                    <label for="confirm" id="conlabel" class="input-group__label">Confirm Password</label>
                    <span id="toggleConPassword" class="eye-icon">&#128065;</span>
                </div>

                <button type="submit" id="reg-btn" class="mybtn">Register</button>
                <br>

                <label for="register-link">Already have an account ?</label>
                <span id="login-link2" class="active">Login</span>


                </fieldset>
            </div>

        </form>


</body>
</html>





