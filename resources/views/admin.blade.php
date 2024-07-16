@extends('layouts.master')

@section('title', 'Home')
@section('content')
    @if (auth()->user()->id_rol == 1)
        <div id="apiAdmin">
            <p>Estás viendo esto porque eres un administrador.</p>
            <div v-show="vista==0">
                <div class="row">
                    <div class="col-3">
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>@{{ usuarios.length }}</h3>
                                <p>usuarios registrados</p>
                            </div>
                            <div class="icon">
                                <i class="fa-solid fa-address-card"></i>
                            </div>
                            <a class="small-box-footer" @click="vista1()">Ver más <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    {{-- Caja para registrar usuarios --}}
                    <div class="col-3">
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
            </div>
            <div v-show="vista==1">
                <div class="row">
                    <div class="col-10">
                        <table id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nombre</th>
                                    <th>Correo Electrónico</th>
                                    <th>Rol</th>
                                    <th>Fecha de creación</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="u in usuarios">
                                    <td>@{{ u.id }}</td>
                                    <td>@{{ u.name }}</td>
                                    <td>@{{ u.email }}</td>
                                    <td>@{{ u.nombre_rol }}</td>
                                    <td>@{{ u.created_at }}</td>
                                    <td>

                                        <button class="btn" style="background-color: #353281"
                                            @click="editarUser(u.id)"><i class="fa-solid fa-pen-to-square"></i></button>

                                        <button class="btn" style="margin-left: 5px; background-color: #c72b2c"
                                            @click="eliminarUsuario(u.id)"><i class="fa-solid fa-trash"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>







            {{-- inicio de ventana modal --}}
            <!-- Modal -->
            <div class="modal fade" id="exampleModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" v-if="agregar==true">Agregando usuario</h4>
                            <h4 class="modal-title" v-if="agregar==false">Editando usuario</h4>
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
                            <br>
                            <div class="col-md-6">
                                <select class="form-control" v-model="rol_S">
                                    <option disabled>Elige una opción</option>
                                    <option v-for="rol in roles" :value="rol.id_rol">@{{ rol.rol }}</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="validarInputs()" v-if="agregar==true">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </button>
                            <button type="button" class="btn btn-primary" @click="actualizarUser()" v-if="agregar==false">
                                actualizarUser
                            </button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>

        <input type="hidden" name="route" value="{{ url('/') }}">
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif


    @push('scripts')
        <script type="module" src="js/apis/apiAdmin.js"></script>
        {{-- <script>
            $(document).ready(function() {
                $('#example').DataTable();
            });
        </script> --}}
    @endpush
   
@endsection
