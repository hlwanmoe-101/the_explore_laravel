<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title',env('APP_NAME'))</title>
    <link rel="icon" href="{{asset('logos/favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('head')
</head>
<body>
<nav class="navbar navbar-expand-lg bg-white position-fixed top-0 w-100 shadow-sm" style="z-index: 5;">
    <div class="container">
        <a class="navbar-brand" href="{{route('index')}}">
            <img src="{{asset('logos/logo.png')}}" width="160" alt="">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">register</a>
                    </li>
                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{auth()->user()->name}}
                            <img src="{{asset(auth()->user()->photo)}}" class="user-img rounded-circle border-3 border-white shadow-sm" alt="">
                        </a>

                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{route('edit-profile')}}">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="{{route('edit-password')}}">Change Password</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#"
                                   onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">Logout</a></li>
                        </ul>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @endauth
            </ul>

        </div>
    </div>
</nav>
<div class="py-5"></div>

@yield('content')
<h1>Ha Ha Ha CICD</h1>
<div class="py-4 text-light text-center bg-primary">
    &copy; {{date("Y")}} Hlwan. All rights Reversed.
</div>
<script src="{{asset('js/app.js')}}"></script>
@stack('script')
</body>
</html>
