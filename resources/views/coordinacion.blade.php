@extends('layouts.master')

@section('title', 'Home')

@section('content')

    @if (auth()->user()->id_rol == 2)
        {{-- <p>Estás viendo esto porque eres un coordinador.</p>
        <h1>
            coordinador
        </h1> --}}
        <div class="row">

            <div class="col-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Maestros</h3>
                        <p>usuarios registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <a class="small-box-footer" href="coordinacion_maestros">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Materias</h3>
                        <p>usuarios registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <a class="small-box-footer" >Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-3">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3>Asignaciones</h3>
                        <p>usuarios registrados</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-address-card"></i>
                    </div>
                    <a class="small-box-footer" >Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif
@endsection
