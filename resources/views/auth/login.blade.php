<!-- @extends('layouts.app')
  
@section('title','Login')

@section('content')


<form  method="POST">
     @csrf
    <input type="text" placeholder="Email"  id="email" name="email">
    <input type="password" placeholder="Password"  id="password" name="password">

	

    <button type="submit">Send</button>

	@error('message')
	<p>{{$message}}</p>

	@enderror
</form> -->


<!DOCTYPE html>
<html lang="es">
<head>
        
        <meta charset="utf-8">
        
        <title> Formulario de Acceso </title>    
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <meta name="author" content="Videojuegos & Desarrollo">
        <meta name="description" content="Ejemplo de formulario de acceso basado en HTML5 y CSS">
        <meta name="keywords" content="login,formulariode acceso html">
        
        <link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet"> 
        
        <!-- Link hacia el archivo de estilos css -->
        <link rel="stylesheet" href="css/cardlogin.css">
        
        <style type="text/css">
            
        </style>
        
        <script type="text/javascript">
        
        </script>
        
    </head>
    
    <body>
    
        <div id="contenedor">
            
            <div id="contenedorcentrado">
                <div id="login">
                    <form id="loginform" method="POST">
                    @csrf
                        <label for="email">Usuario</label>
                        <input id="email" type="text" name="email" placeholder="email">
                        
                        <label for="password">Contraseña</label>
                        <input id="password" type="password" placeholder="Contraseña" name="password">
                        
                        <button type="submit">Login</button>
                    </form>
                    @error('message')
	                <p>{{$message}}</p>

	                @enderror
                    
                </div>
                <div id="derecho">
                    <div class="titulo">
                        Bienvenido
                    </div>
                    <hr>
                    <div class="pie-form">
                        <a href="#">¿Perdiste tu contraseña?</a>
                        <a href="#">¿No tienes Cuenta? Registrate</a>
                        <hr>
                        <a href="#">« Volver</a>
                    </div>
                </div>
            </div>
        </div>
        
    </body>
</html>



