@extends('layouts.master')

@section('title', 'Home')

@section('content')

    @if (auth()->user()->id_rol == 2)
        {{-- <p>Estás viendo esto porque eres un coordinador.</p>
        <h1>
            coordinador
        </h1> --}}
        <div class="row">

            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Maestros</h3>
                        <p>creación</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </div>
                    <a class="small-box-footer" href="coordinacion_maestros">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Licenciatura</h3>
                        <p> y RVOES</p>
                    </div>
                    <div class="icon">
                        <i class="fa-brands fa-slack"></i>
                    </div>
                    <a class="small-box-footer" href="coordinacion_maestros">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Subir </h3>
                        <p>materias</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-clipboard"></i>
                    </div>
                    <a class="small-box-footer" href="mate">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Crear</h3>
                        <p>grupos</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-user-group"></i>
                    </div>
                    <a class="small-box-footer" href="asignacion">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3>Asignar</h3>
                        <p>horas y módulos</p>
                    </div>
                    <div class="icon">
                        <i class="fa-solid fa-layer-group"></i>
                    </div>
                    <a class="small-box-footer" href="asignar">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif
    <input type="hidden" name="route" value="{{ url('/') }}">
@endsection
