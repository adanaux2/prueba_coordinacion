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
        <h2>Bienvenido {{ auth()->user()->name}}</h2>
        <a href="{{ route('login.destroy') }}">Logout</a>
    </div>
    @else

    @endif



    @yield('content')
    
</body>
</html>
