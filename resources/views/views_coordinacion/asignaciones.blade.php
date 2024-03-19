@extends('layouts.master')

@section('title', 'maestos')

@section('content')

    @if (auth()->user()->id_rol == 2)
        <h1>
            vista Asignaciones
        </h1>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif
@endsection
