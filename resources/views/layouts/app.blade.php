<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('name') - laravel app</title>
</head>
<body>
    @if(auth()->check())
    <div>
        <h2>Bienbenido {{ auth()->user()->name}}</h2>
        <a href="{{ route('login.destroy') }}">Logout</a>
    </div>
    @else
    <div>
        <a href="{{route('login.index')}}">Log In</a>
        <a href="{{route('register.index')}}">Register</a>
    </div>
    @endif



    @yield('content')
    
</body>
</html>
