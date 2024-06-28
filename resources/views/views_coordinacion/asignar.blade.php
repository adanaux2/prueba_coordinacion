@extends('layouts.master')

@section('name', 'Lic')

@section('content')

    @if (auth()->user()->id_rol == 2)
        <div id="apiAsignar">
            @{{ mensaje }}
            <div class="row" v-if="principal==0">
                {{-- <div class="col-1"> --}}

                {{-- </div> --}}
                <div class="card card-primary card-outline col-md-12">
                    <div class="card-body">
                        <table id="dataTableGrupos" style="width:100%">
                            <thead>
                                <tr>
                                    {{-- <th>ID</th> --}}
                                    <th>Licenciatura</th>
                                    <th>Rvoe</th>
                                    <th>Año</th>
                                    <th>Cuatrimestre</th>
                                    <th>Periodo</th>
                                    <th>Asignar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="g in grupos">
                                    {{-- <td>@{{ g.id_grupo }}</td> --}}
                                    <td>@{{ g.name[0].licenciatura }}</td>
                                    <td>@{{ g.id_rvoe }}</td>
                                    <td>@{{ g.anio }}</td>
                                    <td>@{{ g.cuatrimestre }}</td>
                                    <td>@{{ g.periodo }}</td>
                                    <td>

                                        <button class="btn" style="background-color: #353281"
                                            @click="editarGrupo(g.id_grupo)"><i
                                                class="fa-solid fa-pen-to-square"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
            <div class="row" v-if="principal==1">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <h5 class="card-title">@{{ unGrupo.name[0].licenciatura }}</h5>

                        <p class="card-text">
                            <strong>Rvoe:</strong> @{{ unGrupo.id_rvoe }} <strong>Año:</strong> @{{ unGrupo.anio }}
                            <strong>Periodo:</strong>
                            @{{ unGrupo.periodo }} <strong>Cuatrimestre:</strong> @{{ unGrupo.cuatrimestre }}
                        </p>
                        <div class="container">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            {{-- <th scope="col">#</th> --}}
                                            <th scope="col">Identificador</th>
                                            <th scope="col">Materia</th>
                                            <th scope="col">Profesor</th>
                                            <th scope="col">Seleccionar</th>
                                            <th scope="col">Hora</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="materia in unGrupo.materias">
                                            {{-- <th scope="row">@{{ materia.id_materia }}</th> --}}
                                            <td>@{{ materia.name }}</td>
                                            <td>@{{ materia.materia }}</td>
                                            {{-- <td>@{{ materia.id_profesor }}</td> --}}
                                            {{-- <td>@{{ materia.hora }}</td> --}}
                                            <td><input type="text" disabled></td>
                                            <td><button class="btn btn-dark" @click="verModal(materia.id_materia)"><i
                                                        class="fa-solid fa-magnifying-glass"></i></button></td>
                                            <td><input type="time" class="form-control"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <a href="#" class="card-link">Card link</a>
                        <a href="#" class="card-link">Another link</a>
                    </div>
                </div><!-- /.card -->
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
                                        <td><button class="btn btn-danger" @click="agregarProfe(m.id_profe)">Agregar</button>
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
        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif

    @push('scripts')
        <script type="module" src="js/apis/apiAsignar.js"></script>
    @endpush
    <input type="hidden" name="route" value="{{ url('/') }}">
@endsection
