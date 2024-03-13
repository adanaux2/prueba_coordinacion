@extends('layouts.master')

@section('title', 'maestos')

@section('content')

    @if (auth()->user()->id_rol == 2)
        
        <h1>
            vista Materias
        </h1>
        <div class="row">
            <div class="col-10">
                
            </div>
        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif
@endsection