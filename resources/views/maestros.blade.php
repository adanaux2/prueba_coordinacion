@extends('layouts.master')

@section('title', 'Home')

@section('content')

    @if (auth()->user()->id_rol == 3)
        <p>Estás viendo esto porque eres un profesor.</p>
        <h1>
            profesor    
        </h1>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif

@endsection
