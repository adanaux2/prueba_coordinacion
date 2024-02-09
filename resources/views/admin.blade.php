@extends('layouts.master')

@section('title', 'Home')

@section('content')
    @if (auth()->user()->id_rol == 1)
        <p>Estás viendo esto porque eres un administrador.</p>
        <h1>
            admin
        </h1>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif
@endsection
