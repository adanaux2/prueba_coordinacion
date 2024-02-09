@extends('layouts.master')

@section('title', 'Home')

@section('content')

    @if (auth()->user()->id_rol == 2)
        <p>Estás viendo esto porque eres un coordinador.</p>
        <h1>
            coordinador
        </h1>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif
@endsection
