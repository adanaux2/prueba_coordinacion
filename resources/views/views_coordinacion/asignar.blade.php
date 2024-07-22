@extends('layouts.master')

@section('name', 'Lic')

@section('content')

    @if (auth()->user()->id_rol == 2)
        <div id="apiAsignar">
            {{-- @{{ mensaje }} --}}
            <div class="row" v-if="principal==0">
                {{-- <div class="col-1"> --}}

                {{-- </div> --}}
                <div class="card card-primary card-outline col-md-12">
                    <div class="card-body">
                        <table id="dataTableGrupos">
                            <thead>
                                <tr>

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
                        <p>
                            <strong>Turno:</strong> @{{ unGrupo.turno }} <strong>Fecha de inicio:</strong>
                            @{{ unGrupo.fecha_inicio }} <strong>Fecha de fin:</strong> @{{ unGrupo.fecha_fin }}
                        </p>

                        <div class="table-responsive">
                            <table id="dataTableGrupos2">
                                <thead>
                                    <tr>
                                        <th scope="col">Identificador</th>
                                        <th scope="col">Materia</th>
                                        <th scope="col">Profesor</th>
                                        <th scope="col">Seleccionar</th>
                                        <th scope="col">Hora de inicio</th>
                                        <th scope="col">Hora de fin</th>
                                        <th scope="col">Modulo</th>
                                        <th scope="col">Editar horas y módulo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="materia in materias">

                                        <td>@{{ materia.name }}</td>
                                        <td>@{{ materia.materia }}</td>

                                        <td><input type="text" disabled :value="materia.name_profesor"></td>
                                        <td><button class="btn btn-dark btn-sm" @click="verModal(materia.id_materia)"
                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Seleccionar profesor"><i
                                                    class="fa-solid fa-magnifying-glass"></i></button>

                                            <button class="btn btn-warning btn-sm" @click="verModal2(materia.id_materia)">
                                                <i class="fa-solid fa-list"></i>
                                            </button>

                                        </td>
                                        <td><input type="text" class="form-control" :value="materia.hora" disabled></td>
                                        <td><input type="text" class="form-control" :value="materia.hora_fin" disabled>
                                        </td>
                                        <td><input type="text" class="form-control" :value="materia.modulo" disabled>
                                        </td>

                                        <td>
                                            <button v-if="materia.name_profesor != null" class="btn btn-dark btn-sm"
                                                @click="verModalHyM(materia.id_materia)" data-bs-toggle="tooltip"
                                                data-bs-placement="top" title="Editar hora y módulo"><i
                                                    class="fa-solid fa-pen"></i></button>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                        <div class="row">
                            <div class="col-2">
                                <button @click="updateItem()" class="btn btn-primary">Guardar asignaciones</button><br>
                            </div>
                            <div class="col-2">
                                <button @click="configurarModulos()" class="btn btn-primary">Ver reporte</button>
                            </div>
                        </div>



                    </div>
                </div><!-- /.card -->
            </div>



            <div class="row" v-if="principal==2">
                {{-- <h6>hola</h6> --}}
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <button @click="verModalPdf()" class="btn btn-primary"
                            v-if="turno === 'Matutino' || turno === 'Nocturno'">Generar PDF</button>
                        <button @click="verModalPdf2()" class="btn btn-primary"
                            v-if="turno==='Dominical' || turno==='Sabatino vespertino' || turno==='Sabatino matutino'">Generar
                            PDF</button>
                        {{-- <iframe id="pdfPreview" width="100%" height="600px"></iframe> --}}
                        {{-- <h5 class="card-title">Módulo 1</h5> --}}
                        <p class="card-text">
                        <div class="table-responsive">
                            <table class="table table-bordered"
                                v-if="turno==='Dominical' || turno==='Sabatino vespertino' || turno==='Sabatino matutino'">
                                <thead>
                                    <tr>
                                        <th scope="col">C</th>
                                        <th scope="col">Asignatura</th>
                                        <th scope="col">Docente</th>
                                        <th scope="col">Horario</th>
                                        <th scope="col" colspan="7" class="text-center">Módulo 1</th>
                                        <th scope="col" rowspan="2">Total horas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <td colspan="3"></td>
                                        <template v-for="fe in fechasMo1">
                                            <td v-for="dia in fe.sabados">@{{ dia }} @{{ fe.mes }}
                                            </td>
                                        </template>
                                        <td></td>
                                    </tr>
                                    <tr v-for="materias in materiasModulo1">
                                        <th scope="row"></th>
                                        <td>@{{ materias.materia }}</td>
                                        <td>@{{ materias.name_profesor }}</td>
                                        <td>@{{ materias.hora }} - @{{ materias.hora_fin }}</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>16</td>
                                    </tr>
                                    <tr v-for="materias in materiasModulo1">
                                        <th class="text-center" colspan="2">Exámenes</th>
                                        <th class="text-center">@{{ materias.materia }}</th>
                                        <th class="text-center"></th>
                                        <th class="text-center" colspan="8">@{{ semanaExamenes.dia }} de
                                            @{{ semanaExamenes.mes }}</th>
                                    </tr>

                                </tbody>
                            </table>
                            <table class="table table-bordered"
                                v-if="turno==='Dominical' || turno==='Sabatino vespertino' || turno==='Sabatino matutino'">
                                <thead>
                                    <tr>
                                        <th scope="col">C</th>
                                        <th scope="col">Asignatura</th>
                                        <th scope="col">Docente</th>
                                        <th scope="col">Horario</th>
                                        <th scope="col" colspan="7" class="text-center">Módulo 2</th>
                                        <th scope="col" rowspan="2">Total horas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <td colspan="3"></td>
                                        <template v-for="fe in fechasMo2">
                                            <td v-for="dia in fe.sabados">@{{ dia }} @{{ fe.mes }}
                                            </td>
                                        </template>
                                        <td></td>
                                    </tr>
                                    <tr v-for="materias in materiasModulo2">
                                        <th scope="row"></th>
                                        <td>@{{ materias.materia }}</td>
                                        <td>@{{ materias.name_profesor }}</td>
                                        <td>@{{ materias.hora }} - @{{ materias.hora_fin }}</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>2</td>
                                        <td>16</td>
                                    </tr>
                                    <tr v-for="materias in materiasModulo2">
                                        <th class="text-center" colspan="2">Exámenes</th>
                                        <th class="text-center">@{{ materias.materia }}</th>
                                        <th class="text-center"></th>
                                        <th class="text-center" colspan="8">@{{ semanaExamenes2.dia }} de
                                            @{{ semanaExamenes2.mes }}</th>
                                    </tr>

                                </tbody>
                            </table>

                            <table class="table table-bordered" v-if="turno === 'Matutino' || turno === 'Nocturno'">
                                <thead>
                                    <tr>
                                        <th scope="col">C</th>
                                        <th scope="col">Asignatura</th>
                                        <th scope="col">Docente</th>
                                        <th scope="col">Horario</th>
                                        <th scope="col" colspan="3" class="text-center">Módulo 1
                                            <span>@{{ turno }}</span>
                                        </th>
                                        <th scope="col" rowspan="2">Total horas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <td colspan="3"></td>
                                        <td>
                                            <p v-for="fe in fechasMo1">@{{ fe.mes }} <span
                                                    v-for="dia in fe.Martes" :key="dia">
                                                    @{{ dia }},
                                                </span></p>
                                        </td>
                                        <td>
                                            <p v-for="fe in fechasMo1">@{{ fe.mes }} <span
                                                    v-for="dia in fe.Miércoles" :key="dia">
                                                    @{{ dia }},
                                                </span></p>
                                        </td>
                                        <td>
                                            <p v-for="fe in fechasMo1">@{{ fe.mes }} <span
                                                    v-for="dia in fe.Jueves" :key="dia">
                                                    @{{ dia }},
                                                </span></p>
                                        </td>

                                        <td></td>
                                    </tr>
                                    <tr v-for="(materias, index) in materiasModulo1" :key="index">
                                        <th scope="row"></th>
                                        <td>@{{ materias.materia }}</td>
                                        <td>@{{ materias.name_profesor }}</td>
                                        <td>@{{ materias.hora }} - @{{ materias.hora_fin }}</td>
                                        <td>@{{ index === 0 ? 2 : 0 }}</td>
                                        <td>@{{ index === 1 ? 2 : 0 }}</td>
                                        <td>@{{ index === 2 ? 2 : 0 }}</td>
                                        <td>16</td>
                                    </tr>
                                    <tr v-for="(materias, index) in materiasModulo1" :key="materias.materia + index">
                                        <th class="text-center" colspan="2">Exámenes</th>
                                        <th class="text-center">@{{ materias.materia }}</th>
                                        <th class="text-center"></th>
                                        <th class="text-center" colspan="4">@{{ semanaExamenes[index]?.fecha }} de
                                            @{{ semanaExamenes[index]?.mes }} </th>
                                        {{-- <th class="text-center" v-for="(examen, index) in semanaExamenes" :key="index">@{{ examen.fecha }}</th> --}}

                                        {{-- <th> @{{ semanaExamenes[index]?.fecha }}</th> --}}
                                    </tr>

                                </tbody>
                            </table>
                            <table class="table table-bordered" v-if="turno === 'Matutino' || turno === 'Nocturno'">
                                <thead>
                                    <tr>
                                        <th scope="col">C</th>
                                        <th scope="col">Asignatura</th>
                                        <th scope="col">Docente</th>
                                        <th scope="col">Horario</th>
                                        <th scope="col" colspan="3" class="text-center">Módulo 2
                                            <span>@{{ turno }}</span>
                                        </th>
                                        <th scope="col" rowspan="2">Total horas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th></th>
                                        <td colspan="3"></td>
                                        <td>
                                            <p v-for="fe in fechasMo2">@{{ fe.mes }} <span
                                                    v-for="dia in fe.Martes" :key="dia">
                                                    @{{ dia }},
                                                </span></p>
                                        </td>
                                        <td>
                                            <p v-for="fe in fechasMo2">@{{ fe.mes }} <span
                                                    v-for="dia in fe.Miércoles" :key="dia">
                                                    @{{ dia }},
                                                </span></p>
                                        </td>
                                        <td>
                                            <p v-for="fe in fechasMo2">@{{ fe.mes }} <span
                                                    v-for="dia in fe.Jueves" :key="dia">
                                                    @{{ dia }},
                                                </span></p>
                                        </td>

                                        <td></td>
                                    </tr>
                                    <tr v-for="(materias, index) in materiasModulo2" :key="index">
                                        <th scope="row"></th>
                                        <td>@{{ materias.materia }}</td>
                                        <td>@{{ materias.name_profesor }}</td>
                                        <td>@{{ materias.hora }} - @{{ materias.hora_fin }}</td>
                                        <td>@{{ index === 0 ? 2 : 0 }}</td>
                                        <td>@{{ index === 1 ? 2 : 0 }}</td>
                                        <td>@{{ index === 2 ? 2 : 0 }}</td>
                                        <td>16</td>
                                    </tr>
                                    <tr v-for="(materias, index) in materiasModulo2" :key="materias.materia + index">
                                        <th class="text-center" colspan="2">Exámenes</th>
                                        <th class="text-center">@{{ materias.materia }}</th>
                                        <th class="text-center"></th>
                                        <th class="text-center" colspan="4">@{{ semanaExamenes2[index]?.fecha }} de
                                            @{{ semanaExamenes2[index]?.mes }} </th>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        </p>
                    </div>
                </div><!-- /.card -->


            </div>

            {{-- modal --}}
            <div class="modal fade" id="modalP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Profesores disponibles</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <table id="dataTable" class="table w-100">
                                <thead>
                                    <tr>

                                        <th>Nombre</th>
                                        <th>Licenciatura</th>
                                        {{-- <th>Correo Electrónico</th> --}}
                                        <th>Disposición</th>
                                        {{-- <tr>Disposición</tr> --}}
                                        <th>Acción</th>
                                    </tr> 

                                </thead>
                                <tbody>
                                    <tr v-for="m in ProfesObtenidos" :key="m.id">
                                        <td>@{{ m.profesor[0].licenciatura }}</td>
                                        <td>@{{ m.profesor[0].nombre_c }}</td>
                                        {{-- <td>@{{ m.profesor[0].nombre_c }}</td> --}}
                                        {{-- <td>@{{ m }}</td>
                                        <td>@{{ m.licenciatura }}</td> --}}
                                        {{-- <td>@{{ m.correo_institucional }}</td> --}}
                                        {{-- <td>@{{ m.curp }}</td> --}}
                                        {{-- <td><button class="btn btn-danger"
                                                @click="agregarProfe(m.id_profe)">Agregar</button>
                                        </td> --}}
                                        <td>
                                            <div v-for="disp in m.profesor[0].disponibilidad" :key="disp.id_disp">
                                                <p>@{{ disp.horario[0].dia }} <span>@{{ disp.horario[0].hora }}</span></p>
                                                {{-- <p>Hora: @{{ disp.horario[0].hora }}</p> --}}
                                                {{-- <p>Turno: @{{ disp.horario[0].turno }}</p> --}}
                                                <hr>
                                            </div>
                                        </td>

                                        <td><button class="btn btn-danger"
                                                @click="agregarProfe(m.id_profe)">Agregar</button>
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
            {{-- modal 2 --}}
            <div class="modal fade" id="modalP2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                            <table id="dataTableTodos">
                                <thead>
                                    <tr>

                                        <th>Nombre</th>
                                        <th>Licenciatura</th>
                                        {{-- <th>Correo Electrónico</th> --}}
                                        {{-- <th>Curp</th> --}}
                                        <th>Acción</th>

                                </thead>
                                <tbody>
                                    <tr v-for="m in todosProfes" :key="m">
                                        <td>@{{ m.nombre_c }}</td>
                                        <td>@{{ m.licenciatura }}</td>
                                        {{-- <td>@{{ m.profesor[0].nombre_c }}</td> --}}
                                        {{-- <td>@{{ m }}</td>
                                        <td>@{{ m.licenciatura }}</td> --}}
                                        {{-- <td>@{{ m.correo_institucional }}</td> --}}
                                        {{-- <td>@{{ m.curp }}</td> --}}
                                        {{-- <td><button class="btn btn-danger"
                                                @click="agregarProfe(m.id_profe)">Agregar</button>
                                        </td> --}}
                                        <td><button class="btn btn-danger"
                                                @click="agregarProfe2(m.id_profe)">Agregar</button>
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
            {{-- fin de modal2 --}}
            {{-- modal hora y modulo --}}
            <div class="modal fade" id="modalHyM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">@{{ name.materia }}</h5>

                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>

                        </div>

                        <div class="modal-body">
                            ...
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Profesor</label>
                                </div>
                                <div class="col-md-6">
                                    <h5>@{{ name.name_profesor }}</h5>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Hora inicio</label>
                                </div>
                                <div class="col-md-4">
                                    <td><input type="time" class="form-control" v-model="hora"></td>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Hora de finalización</label>

                                </div>
                                <div class="col-md-4">
                                    <td><input type="time" class="form-control" v-model="hora_fin"></td>
                                    {{-- <td><input disabled class="form-control" :value="hora_fin"></td> --}}
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="">Módulo</label>

                                </div>
                                <div class="col-md-4">
                                    <td><select name="" id="" class="form-control" v-model="modulo">
                                            <option disabled>Selecciona una opción</option>
                                            <option value="Modulo 1" class="form-control">1</option>
                                            <option value="Modulo 2" class="form-control">2</option>
                                        </select></td>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" @click="updateHora()">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- modal pedfile --}}
            <div class="modal fade" id="modalPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-xl" role="document">
                    <div class="modal-content">


                        <div class="modal-body">
                            <iframe id="pdfPreview" width="100%" height="600px"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif

    @push('scripts')
        <script type="module" src="js/apis/apiAsignar.js"></script>
        {{-- <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.6/dayjs.min.js"></script> --}}
        <!-- Incluir el script de Day.js -->
        <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/dayjs.min.js"></script>
        <!-- Incluir el script de localización en español -->
        <script src="https://cdn.jsdelivr.net/npm/dayjs@1.10.7/locale/es.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.25/jspdf.plugin.autotable.min.js"></script>
    @endpush
    <input type="hidden" name="route" value="{{ url('/') }}">
@endsection
