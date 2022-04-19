<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title',env('APP_NAME'))</title>
    <link rel="icon" href="{{ asset('images/icon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('head')
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white position-fixed top-0 shadow-sm w-100" >
    <div class="container">
        <a class="navbar-brand" href="{{ route('index') }}">
            <img src="{{ asset('images/logo.png') }}" height="40" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            @guest
            <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">Login</a>
            </li>
            <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">Register</a>
            </li>
            @endguest

            @auth
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
                <img src="{{ asset(auth()->user()->photo) }}" class="user-img img-fluid rounded-circle border-1 border-white shadow-sm" alt="">
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                <li><a class="dropdown-item" href="#">Change Password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" onclick="event.preventDefault();document.getElementById('logout-form').submit()" href="#">Logout</a></li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
                </form>
            </ul>
            </li>
            @endauth
        </ul>
        </div>
    </div>
</nav>

<div class="py-5"></div>

@yield('content')

<script src='{{ asset('js/app.js') }}'></script>

@stack('script')

</body>
</html>
