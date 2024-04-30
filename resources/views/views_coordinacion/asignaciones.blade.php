@extends('layouts.master')

@section('title', 'maestos')

@section('content')

    @if (auth()->user()->id_rol == 2)
        <h1>
            vista Asignaciones
        </h1>
        <div class="row">
            <div class="col-lg-3 col-6 mt-4">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>150</h3>
    
                    <p>Consultar</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6 mt-4">
                <!-- small box -->
                <div class="small-box bg-info">
                  <div class="inner">
                    <h3>150</h3>
    
                    <p>Generar</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif
@endsection
