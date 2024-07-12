@extends('layouts.master')

@section('name', 'maestos')

@section('content')

    @if (auth()->user()->id_rol == 2)
        <div id="apiMaterias">
            <h6>Selecciona el Rvoe al que pertenecen las asignaturas a ingresar</h6>
            <div class="row">
                <div class="col-7">
                    <select class="form-control" v-model="id_rvoe">
                        <option disabled>Elige una licenciatura</option>
                        <option v-for="l in rObtenidas" :value="l.id_rvoe">
                            @{{ l.id_rvoe }}</option>
                    </select>
                </div>
            </div>
            <h6>Carga en este espacio tu archivo excel</h6>
            <div class="row" v-if="id_rvoe != null && id_rvoe !== ''">
                <div class="input-group col-7">
                    <input type="file" class="form-control" ref="fileInput" accept=".xls, .xlsx" id="inputGroupFile04"
                        aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <button class="btn btn-dark" type="button" id="inputGroupFileAddon04"
                        @click="importarUsuarios()">Importar materias</button>
                </div>
            </div>
            <br>
            
            {{-- inicio de ventana modal --}}
        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif

    @push('scripts')
        <script type="module" src="js/apis/apiMaterias.js"></script>
    @endpush
    <input type="hidden" name="route" value="{{ url('/') }}">
@endsection
