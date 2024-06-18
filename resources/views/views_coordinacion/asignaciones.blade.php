@extends('layouts.master')

@section('title', 'maestos')

@section('content')

    @if (auth()->user()->id_rol == 2)
        {{-- <h1>
            vista Asignaciones
        </h1> --}}
        <div id="apiAsignacion">
            {{-- <h1>
                @{{ mensaje }}
            </h1> --}}

            <div class="row" v-show="principal==0">
                <div class="col-lg-3 col-6 mt-4">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>

                            <p>Crear grupos</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer" @click="agregarGrupo()">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
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
                        <a href="#" class="small-box-footer" @click="vista1()">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>


            <div class="row" v-show="principal==1">
                {{-- modulo 1 --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <h1>ASIGNACIÓN DE MATERIAS / MÓDULO I

                                </h1>
                                <br>
                                <button class="btn btn-danger" @click="verModal()">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="img/logos.png" style="width: 200px; height: auto;">
                                </div>
                                <br>
                                <div class="col-md-2">
                                    <p>DOCENTE: </p>
                                    <br>
                                    <p>LICENCIATURA EN: </p>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" placeholder="Nombre" class="form-control" disabled
                                        v-model="usuarioSeleccionado.nombre_c">
                                    <br>
                                    <input disabled class="form-control" v-model="usuarioSeleccionado.licenciatura">
                                </div>
                                <div class="col-2">
                                    <p>CICLO: </p>
                                    <br>
                                    <p>CORREO: </p>
                                </div>
                                <div class="col-3">
                                    <input type="text" placeholder="Ejemplo .24-2" class="form-control">
                                    <br>
                                    <input disabled class="form-control" v-model="usuarioSeleccionado.correo_institucional">
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                {{-- horario semanal --}}
                                <div class="col 4">
                                    <h5 class="text-center">
                                        HORARIO SEMANAL
                                    </h5>
                                    <table class="table" style="text-align: center;">
                                        <thead class="table-active" style="background-color: #1341A3; color: #ffffff">
                                            <tr>
                                                <th scope="col">ASIGNATURA</th>
                                                <th scope="col">DIA</th>
                                                <th scope="col">INICIO</th>
                                                <th scope="col">HORARIO</th>
                                                <th scope="col">CUATRIMESTRE</th>
                                                <th scope="col">lICENCIATURA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th><input type="text" class="form-control"></th>
                                                <td>Martes</td>
                                                <td class="table-active" style="background-color: #1341A3; color: #ffffff">
                                                    <input type="date" class="form-control">
                                                </td>
                                                <td>8:00-10:00</td>
                                                <td><input type="text"></td>
                                                <td><input type="text"></td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                                {{-- fin de horario semanal --}}


                            </div>
                            <div class="row">
                                {{-- horario sabatino --}}
                                <div class="col 4">
                                    <h5 class="text-center">
                                        HORARIO SABATINO
                                    </h5>

                                </div>
                                {{-- fin dehorario sabatino --}}
                            </div>
                            <div class="row">
                                {{-- horario dominical --}}
                                <div class="col 4">
                                    <h5 class="text-center">
                                        HORARIO DOMINICAL
                                    </h5>

                                </div>
                                {{-- fin de horario dominical --}}
                            </div>

                        </div>
                    </div>
                </div>
                {{-- modulo 2 --}}
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12 d-flex justify-content-center align-items-center">
                                <h1>ASIGNACIÓN DE MATERIAS / MÓDULO II

                                </h1>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="img/logos.png" style="width: 200px; height: auto;">
                                </div>
                                <br>
                                <div class="col-md-2 mb-4">
                                    <p>DOCENTE: </p>
                                    <br>
                                    <p>LICENCIATURA EN: </p>
                                </div>
                                <div class="col-md-3">
                                    <input type="text" placeholder="Nombre" class="form-control" disabled
                                        v-model="usuarioSeleccionado.nombre_c">
                                    <br>
                                    <input disabled class="form-control" v-model="usuarioSeleccionado.licenciatura">
                                </div>
                                <div class="col-2">
                                    <p>CICLO: </p>
                                    <br>
                                    <p>CORREO: </p>
                                </div>
                                <div class="col-3">
                                    <input type="text" placeholder="Ejemplo .24-2" class="form-control">
                                    <br>
                                    <input disabled class="form-control" v-model="usuarioSeleccionado.correo_institucional">
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                {{-- horario semanal --}}
                                <div class="col 4">
                                    <h5 class="text-center">
                                        HORARIO SEMANAL
                                    </h5>
                                    <table class="table" style="text-align: center;">
                                        <thead class="table-active" style="background-color: #1341A3; color: #ffffff">
                                            <tr>
                                                <th scope="col">ASIGNATURA</th>
                                                <th scope="col">DIA</th>
                                                <th scope="col">INICIO</th>
                                                <th scope="col">HORARIO</th>
                                                <th scope="col">CTM</th>
                                                <th scope="col">lICENCIATURA</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th><input type="text" class="form-control"></th>
                                                <td>Martes</td>
                                                <td class="table-active"
                                                    style="background-color: #1341A3; color: #ffffff">
                                                    <input type="date" class="form-control">
                                                </td>
                                                <td>8:00-10:00</td>
                                                <td><input type="text"></td>
                                                <td><input type="text"></td>
                                            </tr>

                                        </tbody>
                                    </table>

                                </div>
                                {{-- fin de horario semanal --}}


                            </div>
                            <div class="row">
                                {{-- horario sabatino --}}
                                <div class="col 4">
                                    <h5 class="text-center">
                                        HORARIO SABATINO
                                    </h5>

                                </div>
                                {{-- fin dehorario sabatino --}}
                            </div>
                            <div class="row">
                                {{-- horario dominical --}}
                                <div class="col 4">
                                    <h5 class="text-center">
                                        HORARIO DOMINICAL
                                    </h5>

                                </div>
                                {{-- fin de horario dominical --}}
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            {{-- modal --}}
            <div class="modal fade" id="modalP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            ...
                            <table id="dataTable">
                                <thead>
                                    <tr>

                                        <th>Nombre</th>
                                        <th>Licenciatura</th>
                                        <th>Correo Electrónico</th>
                                        <th>Curp</th>
                                        <th>Acción</th>

                                </thead>
                                <tbody>
                                    <tr v-for="m in ProfesObtenidos" :key="m.id">
                                        <td>@{{ m.nombre_c }}</td>
                                        <td>@{{ m.licenciatura }}</td>
                                        <td>@{{ m.correo_institucional }}</td>
                                        <td>@{{ m.curp }}</td>
                                        <td><button class="btn btn-danger" @click="agregarUsuario(m)">Agregar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin de modal --}}

            {{-- modal --}}
            <div class="modal fade" id="modalNG" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal Agregar grupos</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <h6>Licenciatura en:</h6>
                                </div>
                                <div class="col-8">
                                    <select class="form-control" id="" v-model="licenciaturaSelected">
                                        <option disabled>Selecciona una licenciatura</option>
                                        <option :value="lic.id_licenciatura" v-for="lic in lisc">@{{ lic.licenciatura }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <h6>RVOE:</h6>
                                </div>
                                <div class="col-8">
                                    <select class="form-control" id="" v-model="rvoeSelected">
                                        <option disabled>Selecciona el RVOE</option>
                                        <option :value="rvoe.id_rvoe" v-for="rvoe in licRvoe">@{{ rvoe.id_rvoe }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <h6>Periodo:</h6>
                                </div>
                                <div class="col-6">
                                    <select class="form-control" id="" v-model="periodoSelected">
                                        <option disabled>Selecciona el periodo</option>
                                        <option value="">Enero - Abril</option>
                                        <option value="">Mayo - Agosto</option>
                                        <option value="">Septiembre - Diciembre</option>
                                    </select>
                                </div>
                                <div class="col-2">
                                    <input type="text" v-model="year" class="form-control" disabled>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-4">
                                    <h6>Cuatrimestre:</h6>
                                </div>
                                <div class="col-8">
                                    <select class="form-control" id="" v-model="cuatriSelected">
                                        <option disabled>Selecciona el cuatrimestre</option>
                                        <option value="1">Primer cuatrimestre</option>
                                        <option value="2">Segundo cuatrimestre</option>
                                        <option value="3">Tercer cuatrimestre</option>
                                        <option value="4">Cuarto cuatrimestre</option>
                                        <option value="5">Quinto cuatrimestre</option>
                                        <option value="6">Sexto cuatrimestre</option>
                                        <option value="7">Septimo cuatrimestre</option>
                                        <option value="8">Octavo cuatrimestre</option>
                                        <option value="9">Noveno cuatrimestre</option>
                                        <option value="10">Décimo cuatrimestre</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- fin de modal --}}

        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif

    @push('scripts')
        <script type="module" src="js/apis/apiAsignaciones.js"></script>
    @endpush
    <input type="hidden" name="route" value="{{ url('/') }}">
@endsection
