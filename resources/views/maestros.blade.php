@extends('layouts.master')

@section('title', 'Home')

@section('content')

    @if (auth()->user()->id_rol == 3)
        <p>Estás viendo esto porque eres un profesor.</p>
        <div id="apiProfes">
            {{-- @{{ mensaje }} --}}
            <div class="row" v-show="principal==0">
                <div class="col-lg-3 col-6 mt-4">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>Mis datos</h3>

                            {{-- <p>Consultar</p> --}}
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer" @click="vista2()">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6 mt-4">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>LLenar</h3>

                            {{-- <p>Consultar</p> --}}
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer" @click="vista1()">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                    <input type="hidden" value="{{ auth()->user()->curp }}" id="curpInput">

                </div>

            </div>
            <div v-show="principal==1">
                {{-- <h1>formulario</h1> --}}

                <div class="col-12">
                    <!-- Custom Tabs -->
                    <div class="card">
                        <div class="card-header d-flex p-0">
                            <h3 class="card-title p-3">Formularios</h3>
                            <ul class="nav nav-pills ml-auto p-2">
                                <li class="nav-item"><a class="nav-link active" href="#tab_1"
                                        data-toggle="tab">Disponibilidad</a></li>
                                <li class="nav-item"><a class="nav-link" href="#tab_2" data-toggle="tab">Mapa
                                        curricular</a>
                                </li>

                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="callout callout-info" v-if="mostrar==0">

                                        <h5>MARTES</h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>MATUTINO 8:00-10:00 <input type="checkbox" id="myCheckbox"
                                                        :value="1" v-model="martes1"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>NOCTURNO 20:00-22:00 <input type="checkbox" id="myCheckbox"
                                                        :value="2" v-model="martes2"></p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="callout callout-info" v-if="mostrar==0">

                                        <h5>MIÉRCOLES</h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>MATUTINO 8:00-10:00 <input type="checkbox" id="myCheckbox"
                                                        :value="3" v-model="miercoles1"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>NOCTURNO 20:00-22:00 <input type="checkbox" id="myCheckbox"
                                                        :value="4" v-model="miercoles2"></p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="callout callout-info" v-if="mostrar==0">

                                        <h5>JUEVES</h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>MATUTINO 8:00-10:00 <input type="checkbox" id="myCheckbox"
                                                        :value="5" v-model="jueves1"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>NOCTURNO 20:00-22:00 <input type="checkbox" id="myCheckbox"
                                                        :value="6" v-model="jueves2"></p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="callout callout-info" v-if="mostrar==0">

                                        <h5>SÁBADO MATUTÍNO </h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>7:00-9:00 HRS <input type="checkbox" id="myCheckbox"
                                                        :value="7" v-model="sabado1"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>9:00-11:00 HRS <input type="checkbox" id="myCheckbox"
                                                        :value="8" v-model="sabado2"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>11:00-13:00 HRS <input type="checkbox" id="myCheckbox"
                                                        :value="9" v-model="sabado3"></p>
                                            </div>
                                        </div>


                                    </div>
                                    <div class="callout callout-info" v-if="mostrar==0">

                                        <h5>SÁBADO VESPERTINO</h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>13:00-15:00 HRS <input type="checkbox" id="myCheckbox"
                                                        :value="10" v-model="sabado4"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>15:00-17:00 HRS <input type="checkbox" id="myCheckbox"
                                                        :value="11" v-model="sabado5"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>17:00-19:00 HRS <input type="checkbox" id="myCheckbox"
                                                        :value="12" v-model="sabado6"></p>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="callout callout-info" v-if="mostrar==0">

                                        <h5>DOMINICAL</h5>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>7:00-9:00 HRS <input type="checkbox" id="myCheckbox"
                                                        :value="13" v-model="domingo1"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>9:00-11:00 HRS <input type="checkbox" id="myCheckbox"
                                                        :value="14" v-model="domingo2"></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p>11:00-13:00 HRS <input type="checkbox" id="myCheckbox"
                                                        :value="15" v-model="domingo3"></p>
                                            </div>
                                        </div>


                                    </div>
                                    <button class="btn btn-dark"  v-if="mostrar==0">
                                        Guardar
                                    </button>
                                    <div class="row" v-if="mostrar==1">
                                        <h3>eliminar disposicion actual</h3>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_2">
                                    <div class="row" v-if="mostrar2==0">
                                        <div class="card col-12" v-for="licenciatura in lisc">
                                            <div class="card-body">
                                                <div class="card card-danger collapsed-card" >
                                                    <div class="card-header">
                                                        <h3 class="card-title">@{{ licenciatura.licenciatura }}</h3>
                        
                                                        <div class="card-tools">
                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                <i class="fas fa-minus"></i>
                                                            </button>
                                                        </div>
                                                        <!-- /.card-tools -->
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <div class="card-body">
                                                        <div class="card col-12" v-for="rvoe in licenciatura.rvoe">
                                                            <div class="card-body">
                                                                <div class="card card-info collapsed-card">
                                                                    <div class="card-header">
                                                                        <h3 class="card-title"> @{{ rvoe.id_rvoe }}</h3>
                                                                     
                                                                        <div class="card-tools">
                                                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                                                <i class="fas fa-minus"></i>
                                                                            </button>
                                                                            
                                                                        </div>
                                                                        <!-- /.card-tools -->
                                                                    </div>
                                                                    <!-- /.card-header -->
                                                                    <div class="card-body">
                                                                        <table class="table">
                                                                            <thead>
                                                                              <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Identificador</th>
                                                                                <th scope="col">Asignatura</th>
                                                                                <th scope="col">Acción</th>
                                                                              </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr v-for="(materia, index) in rvoe.materias" :key="index">
                                                                                <th scope="row">@{{ index + 1 }}</th>
                                                                                <td>@{{materia.name}}</td>
                                                                                <td>@{{materia.materia}}</td>
                                                                                <td>
                                                                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                                                        <input type="checkbox" class="custom-control-input" :id="'customSwitch' + index" v-model="materia.selected"   @change="handleCheckboxChange(materia)">
                                                                                        <label class="custom-control-label"  :for="'customSwitch' + index"></label>
                                                                                    </div>
                                                                                </td>
                                                                              </tr>
                                                                            </tbody>
                                                                          </table>
                                                                    </div>
                                                                    <!-- /.card-body -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- /.card-body -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-default" v-if="mostrar2==0" @click="saveSelected()">Guardar Seleccionados</button>
                                    <div class="row" v-if="mostrar2==1">
                                        <h3>Eliminar mapa curricular actual</h3>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- ./card -->
                  
                </div>



            </div>

            <div v-show="principal==2">
                <div class="card">
                    <div class="card-header d-flex p-0">
                        <h3 class="card-title p-3">Formularios</h3>
                        <ul class="nav nav-pills ml-auto p-2">
                            <li class="nav-item"><a class="nav-link active" href="#tab_3" data-toggle="tab">Datos
                                    personales</a></li>
                            <li class="nav-item"><a class="nav-link" href="#tab_4" data-toggle="tab">Disponibilidad</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#tab_5" data-toggle="tab">Mapa curricular</a>
                            </li>

                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_3">
                                <div class="row">
                                    <div class="card w-100">
                                        <div class="card-body">
                                            <h3 class="text-center">Mi información</h3>
                                            <br>
                                            <div class="row">
                                                <div class="col-6">
                                                    <h6>Datos de sesión</h6>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Nombre de usuario"
                                                            class="form-control" value="{{ auth()->user()->name }}"
                                                            disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="email" disabled placeholder="Correo"
                                                            class="form-control" value="{{ auth()->user()->email }}">
                                                    </div>


                                                    <br>
                                                    <h6>Grado de estudios</h6>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Licenciatura"
                                                            class="form-control" v-model="maestro.licenciatura" disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="text"
                                                            placeholder="Cedula profecional licenciatura"
                                                            class="form-control" v-model="maestro.c_licenciatura"
                                                            disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Maestría" class="form-control"
                                                            v-model="maestro.maestria" disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Cedula profecional Maestria"
                                                            class="form-control" v-model="maestro.c_maestria" disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Doctorado"
                                                            class="form-control" v-model="maestro.doctorado" disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Cedula profecional Doctorado"
                                                            class="form-control" v-model="maestro.c_doctorado" disabled>
                                                    </div>
                                                    <br>
                                                    <h6>Inglés</h6>
                                                    <div class="form-group">
                                                        <label>Habla:</label>
                                                        <input type="text" class="form-control"
                                                            v-model="maestro.habla" disabled>

                                                    </div>
                                                    <div class="form-group">
                                                        <label>Escribe:</label>
                                                        <input type="text" class="form-control"
                                                            v-model="maestro.escribe" disabled>

                                                    </div>
                                                    <div class="form-group">
                                                        <label>Lee:</label>
                                                        <input type="text" class="form-control" v-model="maestro.lee"
                                                            disabled>

                                                    </div>

                                                </div>
                                                <div class="col-6">
                                                    <h6>Datos generales</h6>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Nombre completo"
                                                            class="form-control" v-model="maestro.nombre_c" disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="domicilio" placeholder="Domicilio"
                                                            class="form-control" v-model="maestro.domicilio" disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="number" placeholder="Teléfono" class="form-control"
                                                            v-model="maestro.telefono" disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Correo institucional"
                                                            class="form-control" v-model="maestro.correo_institucional"
                                                            disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        {{-- <input type="text" placeholder="Género" class="form-control"
                                                        v-model="genero"> --}}
                                                        <input type="text" class="form-control"
                                                            v-model="maestro.genero" disabled>

                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="text" class="form-control"
                                                            v-model="maestro.f_nacimiento" disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Lugar de nacimiento"
                                                            class="form-control" v-model="maestro.l_nacimiento" disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="RFC" class="form-control"
                                                            v-model="maestro.rfc" disabled>
                                                    </div>
                                                    <br>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="CURP" class="form-control"
                                                            v-model="maestro.curp" disabled>
                                                    </div>
                                                    <br>
                                                    <h6>Números de contacto</h6>

                                                    <h6>Contácto 1</h6>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Nombre de contacto 1"
                                                            class="form-control" v-model="maestro.nombre_contacto"
                                                            disabled>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Relación" class="form-control"
                                                            v-model="maestro.relacion_contacto" disabled>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <input type="number" placeholder="Teléfono" class="form-control"
                                                            v-model="maestro.telefono_contacto" disabled>
                                                    </div>
                                                    <br>
                                                    <h6>Contácto 2(Opcional)</h6>
                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Nombre de contacto 2"
                                                            class="form-control" v-model="maestro.nombre_contacto2"
                                                            disabled>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <input type="text" placeholder="Relación" class="form-control"
                                                            v-model="maestro.relacion_contacto2" disabled>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <input type="number" placeholder="Teléfono" class="form-control"
                                                            v-model="maestro.telefono_contacto2" disabled>
                                                    </div>




                                                </div>
                                            </div>

                                        </div>
                                    </div>


                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_4">
                                <div class="callout callout-info" v-for="dia in disp">

                                    <h5>@{{ dia.horario[0].dia }}</h5>
                                    <div class="row">
                                        <div class="col-6">
                                            <p>@{{ dia.horario[0].hora }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div v-if="mostrar==1">
                                    <button class="btn btn-dark" @clicK="eliminarDisp()">Eliminar disponibilidad</button>
                                </div>
                                <div v-if="mostrar==0">
                                    <h3>Aún no llenas tu disponibilidad</h3>
                                </div>
                            </div>

                            <div class="tab-pane" id="tab_5">
                                <div class="callout callout-info" v-for="materia in MapaGuardado" v-if="mostrar2==1">

                                    {{-- <h5>hola mundo</h5> --}}
                                    <div v-for="mat in materia.materias">
                                        <h6>@{{mat.materia}}</h6>
                                        <h6>RVOE @{{mat.id_rvoe}}</h6>
                                    </div>
                                    
                                </div>
                                <div v-if="mostrar2==1" @clicK="EliminarMapa()">
                                    <button class="btn btn-dark">Eliminar mapa curricular</button>
                                </div>
                                <div v-if="mostrar2==0">
                                    <h3>Aún no llenas tu mapa curricular</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>

            </div>

        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif
    @push('scripts')
        <script type="module" src="js/apis/apiMaestros.js"></script>
    @endpush
    <input type="hidden" name="route" value="{{ url('/') }}">
@endsection
