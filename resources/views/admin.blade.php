@extends('layouts.master')

@section('title', 'Home')

@section('content')
    @if (auth()->user()->id_rol == 1)
        <div id="apiAdmin">
            <p>Estás viendo esto porque eres un administrador.</p>
            <p>@{{ message }}</p>
            {{-- Caja de usuarios registrados --}}
            {{-- este div es el inicio del objeto vue3 --}}

            <div class="row">
                <div class="col">
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
                <div class="col">
                    <div class="small-box bg-warning">
                        <div class="inner" style="background:rgb(29, 194, 70)">
                            <h3>+</h3>
                            <p>Registar Usuarios</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-address-book"></i>
                        </div>
                        <a class="small-box-footer" style="background:rgb(25, 165, 60)" @click="openModal()">Ver más <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>




            <!-- Button trigger modal -->
            {{-- <button class="btn btn-danger" >
                modal
            </button> --}}
            {{-- inicio de ventana modal --}}
            <!-- Modal -->
            <div class="modal fade" id="exampleModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregando usuario</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-6">
                                <input type="text" placeholder="Nombre de usuario" class="form-control" v-model="name">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <input type="email" placeholder="Correo" class="form-control" v-model="email">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <input type="password" placeholder="Contraseña" class="form-control" v-model="password">
                            </div>


                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="validarInputs()">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
        {{-- fin de ventana modal --}}
        {{-- este div es el fin del objeto vue3 --}}
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif

    <!-- Include your custom JavaScript file -->
    <script type="module" src="js/apis/apiAdmin.js"></script>
@endsection
