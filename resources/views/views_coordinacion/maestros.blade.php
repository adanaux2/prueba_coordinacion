@extends('layouts.master')

@section('title', 'maestos')

@section('content')

    @if (auth()->user()->id_rol == 2)
        {{-- inicio de objeto vue --}}
        <div id="apiMaestros">
            {{-- <h1>
                @{{ message }}
            </h1> --}}
            {{-- vista 0 --}}
            <div class="row" v-show="vista==0">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>@{{ maestrosObtenidos.length }}</h3>

                            <p>Maestros</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-graduation-cap"></i>
                        </div>
                        <a class="small-box-footer" @click="vista1()">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3> <i class="fa-solid fa-plus"></i></h3>

                            <p>Agregar</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-plus"></i>
                        </div>
                        <a class="small-box-footer" @click="openModal()">Ver más <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

            </div>
            {{-- final de vista 0 --}}
            {{-- vista 1 --}}
            <div class="row" v-show="vista==1">
                {{-- <h1>@{{ maestrosObtenidos }}</h1> --}}

                <div class="col-md-10">
                    <table id="dataTable">
                        <thead>
                            <tr>

                                <th>Nombre</th>
                                <th>Licenciatura</th>
                                <th>Correo Electrónico</th>
                                <th>Curp</th>

                        </thead>
                        <tbody>
                            <tr v-for="m in maestrosObtenidos">
                                <td>@{{ m.nombre_c }}</td>
                                <td>@{{ m.licenciatura }}</td>
                                <td>@{{ m.correo_institucional }}</td>
                                <td>@{{ m.curp }}</td>

                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
            {{-- final de vista 0 --}}






            <!-- Modal -->
            <div class="modal fade" id="exampleModal">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregando maestro</h4>
                            {{-- <h4 class="modal-title" v-if="agregar==false">Editando usuario</h4> --}}
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-6">
                                    <h6>Datos de sesión</h6>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nombre de usuario" class="form-control"
                                            v-model="name">
                                    </div>
                                    <br>
                                    {{-- <div class="col-md-12">
                                        <input type="email" placeholder="Correo institucional" class="form-control" v-model="email">
                                    </div> --}}
                                    {{-- <br> --}}
                                    <div class="col-md-12">
                                        <input type="password" placeholder="Contraseña" class="form-control"
                                            v-model="password">
                                    </div>
                                    <br>
                                    <h6>Grado de estudios</h6>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Licenciatura" class="form-control"
                                            v-model="licenciatura">
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Cedula profecional licenciatura"
                                            class="form-control" v-model="c_licenciatura">
                                    </div>
                                    {{-- <br>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Maestría" class="form-control"
                                            v-model="maestria">
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Cedula profecional Maestria" class="form-control"
                                            v-model="c_maestria">
                                    </div> --}}
                                    {{-- <br>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Doctorado" class="form-control"
                                            v-model="doctorado">
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Cedula profecional Doctorado"
                                            class="form-control" v-model="c_doctorado">
                                    </div> --}}
                                    {{-- <br>
                                    <h6>Inglés</h6>
                                    <div class="form-group">
                                        <label>Habla:</label>
                                        <input type="range" class="form-control-range" id="valor" name="valor"
                                            min="0" max="100" value="50" v-model="valorHabla">
                                        <output>@{{ valorHabla }}%</output>
                                    </div>
                                    <div class="form-group">
                                        <label>Escribe:</label>
                                        <input type="range" class="form-control-range" id="valor" name="valor"
                                            min="0" max="100" value="50" v-model="valorEscribe">
                                        <output>@{{ valorEscribe }}%</output>
                                    </div>
                                    <div class="form-group">
                                        <label>Lee:</label>
                                        <input type="range" class="form-control-range" id="valor" name="valor"
                                            min="0" max="100" value="50" v-model="valorLee">
                                        <output>@{{ valorLee }}%</output>
                                    </div> --}}

                                </div>
                                <div class="col-6">
                                    <h6>Datos generales</h6>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nombre completo" class="form-control"
                                            v-model="nombre_c">
                                    </div>
                                    {{-- <br> --}}
                                    {{-- <div class="col-md-12">
                                        <input type="domicilio" placeholder="Domicilio" class="form-control"
                                            v-model="domicilio">
                                    </div> --}}
                                    {{-- <br>
                                    <div class="col-md-12">
                                        <input type="number" placeholder="Teléfono" class="form-control"
                                            v-model="telefono">
                                    </div> --}}
                                    <br>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-12">
                                                <input type="text" placeholder="Correo institucional"
                                                    class="form-control" v-model="correo_institucional">
                                            </div>
                                        </div>
                                        {{-- <div class="row">
                                            <div class="col-12">
                                             @{{ emailFormatted }}
                                            </div>
                                        </div> --}}
                                    </div>


                                    <br>
                                    {{-- <div class="col-md-12">
                                       
                                        <select class="form-control" :value v-model="genero">
                                            <option disabled>Selecciona una opcion</option>
                                            <option value="Masculino">Masculino</option>
                                            <option value="Femenino">Femenino</option>
                                        </select>
                                    </div>
                                    <br> --}}
                                    {{-- <div class="col-md-12">
                                        <input type="date" placeholder="Fecha de nacimiento" class="form-control"
                                            v-model="f_nacimiento">
                                    </div> --}}
                                    {{-- <br>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Lugar de nacimiento" class="form-control"
                                            v-model="l_nacimiento">
                                    </div>
                                    <br> --}}
                                    {{-- <div class="col-md-12">
                                        <input type="text" placeholder="RFC" class="form-control" v-model="rfc">
                                    </div>
                                    <br> --}}
                                    <div class="col-md-12">
                                        <input type="text" placeholder="CURP" class="form-control" v-model="curp">
                                    </div>
                                    <br>
                                    {{-- <h6>Números de contacto</h6>

                                    <h6>Contácto 1</h6>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nombre de contacto 1" class="form-control"
                                            v-model="nombre_contacto">
                                    </div>

                                    <div class="col-md-12">
                                        <input type="text" placeholder="Relación" class="form-control"
                                            v-model="relacion_contacto">
                                    </div>

                                    <div class="col-md-12">
                                        <input type="number" placeholder="Teléfono" class="form-control"
                                            v-model="telefono_contacto">
                                    </div>
                                    <br>
                                    <h6>Contácto 2(Opcional)</h6>
                                    <div class="col-md-12">
                                        <input type="text" placeholder="Nombre de contacto 2" class="form-control"
                                            v-model="nombre_contacto2">
                                    </div>

                                    <div class="col-md-12">
                                        <input type="text" placeholder="Relación" class="form-control"
                                            v-model="relacion_contacto2">
                                    </div>

                                    <div class="col-md-12">
                                        <input type="number" placeholder="Teléfono" class="form-control"
                                            v-model="telefono_contacto2">
                                    </div> --}}




                                </div>
                            </div>

                            <br>
                            {{-- <div class="col-md-6">
                                <select class="form-control" v-model="rol_S">
                                    <option disabled>Elige una opción</option>
                                    <option v-for="rol in roles" :value="rol.id_rol">@{{ rol.rol }}</option>
                                </select>
                            </div> --}}

                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary" @click="guardarUsuario()">
                                <i class="fa-solid fa-floppy-disk"></i>
                            </button>
                            {{-- <button type="button" class="btn btn-primary" @click="actualizarUser()" v-if="agregar==false">
                                actualizarUser
                            </button> --}}
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            <!-- /.modal -->
        </div>
        {{-- fin de objeto vue --}}
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif
    @push('scripts')
        <script type="module" src="js/apis/apiMaestrosCoordinacion.js"></script>
    @endpush
    <input type="hidden" name="route" value="{{ url('/') }}">
@endsection
