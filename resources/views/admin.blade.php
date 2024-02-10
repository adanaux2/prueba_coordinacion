@extends('layouts.master')

@section('title', 'Home')

@section('content')
    @if (auth()->user()->id_rol == 1)
        <p>Estás viendo esto porque eres un administrador.</p>
        {{-- Caja de usuarios registrados --}}
        <div class="row">
            <div class="col col-md-6">
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
            </div>
            {{-- Caja para registrar usuarios --}}
            <div class="col md-3">
                <div class="small-box bg-warning">
                    <div class="inner" style="background:rgb(29, 194, 70)">
                        <h3>+</h3>
                        <p>Registar Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-address-book"></i>
                    </div>
                    <a href="" class="small-box-footer" style="background:rgb(25, 165, 60)">Ver más <i
                            class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif
@endsection
