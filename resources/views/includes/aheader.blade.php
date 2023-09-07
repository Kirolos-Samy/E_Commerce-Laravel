<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/header.css')}}">
    <script src="{{ asset('js/header.js') }}" defer></script>
    <title>Just Click</title>
</head>
<body>
    <nav class="navbar">
        <div class="logo">
            <img src="/images/logo.png" alt="Logo">
        </div>
        <div class="navbar-toggle" id="navbar-toggle">
            <div class="bar"></div>
            <div class="bar"></div>
            <div class="bar"></div>
        </div>
        <ul class="navbar-links">
            <li><a href="/admin">Products</a></li>
            <li><a href="/categories">Categories</a></li>
            <li><a href="/orders">Orders</a></li>
            <li><a href="/account">Account</a></li>
        </ul>
        <div class="theme-toggle" id="theme-toggle">
            <span class="light-mode">Light</span>
            <div class="toggle-switch">
                <div class="toggle-switch-slider"></div>
            </div>
            <span class="dark-mode">Dark</span>
        </div>
    </nav>

</body>
</html>
