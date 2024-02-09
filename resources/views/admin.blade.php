@extends('layouts.master')

@section('title', 'Home')

@section('content')
    @if (auth()->user()->id_rol == 1)
        <p>Estás viendo esto porque eres un administrador.</p>
        <div class="small-box bg-warning">
            <div class="inner">
                 <h3>44</h3>
                 <p>usuarios registrados</p>
            </div>
            <div class="icon">
                <i class="fa-solid fa-address-card"></i>
            </div>
            <a href="" class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif
@endsection
