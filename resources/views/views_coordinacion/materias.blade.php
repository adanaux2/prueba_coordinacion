@extends('layouts.master')

@section('name', 'maestos')

@section('content')

    @if (auth()->user()->id_rol == 2)
        <div id="apiMaterias">
            <h1>
                vista materias
                @{{ mensaje }}

            </h1>
            <h6>Carga en este espacio tu archivo excel</h6>
            <div class="row">
                
               
                <div class="input-group col-7">
                    <input type="file" class="form-control" ref="fileInput" accept=".xls, .xlsx" id="inputGroupFile04" aria-describedby="inputGroupFileAddon04"
                        aria-label="Upload">
                    <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04" @click="importarUsuarios()">Importar Usuarios</button>
                </div>
                {{-- <input type="file" ref="fileInput" accept=".xls, .xlsx">
                <button @click="importarUsuarios">Importar Usuarios</button> --}}
                {{-- <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file">
                    <input type="submit" value="IMPORTAR">
                </form> --}}
            </div>
            <br>
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
            {{-- <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>@{{ materias.length }}</h3>

                            <p>Materias</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <a class="small-box-footer">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <div class="col-3">
                    <div class="small-box bg-warning">
                        <div class="inner" style="background:rgb(36, 194, 57)">
                            <h3>+</h3>
                            <p>Registar Materias</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-book"></i>
                        </div>
                        <a class="small-box-footer" style="background:rgb(30, 161, 47)" @click="openModal()">Ver más <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div> --}}


            {{-- inicio de ventana modal --}}
            <!-- Modal -->
            <div class="modal fade" id="exampleModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar materia</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-6">
                                <input type="text" placeholder="Nombre de materia" class="form-control"
                                    v-model="nMateria">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <select class="form-control" v-model="cuatrimestre">
                                    <option disabled>Elige el cuatrimestre</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                            <br>
                            {{-- <div class="col-md-6">
                                <select class="form-control" v-model="licenciatura">
                                    <option disabled>Elige una licenciatura</option>
                                    <option v-for="l in licenciaturasObtenidas" :value="l.id_licenciatura">
                                        @{{ l.licenciatura }}</option>
                                </select>
                            </div> --}}

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk" @click="guardarMateria()"></i>
                            </button>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->






        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif

    @push('scripts')
        <script type="module" src="js/apis/apiMaterias.js"></script>
    @endpush
    <input type="hidden" name="route" value="{{url('/')}}">
@endsection
