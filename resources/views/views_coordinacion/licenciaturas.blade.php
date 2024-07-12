@extends('layouts.master')

@section('name', 'Lic')

@section('content')

    @if (auth()->user()->id_rol == 2)
        <div id="apiLic">
            {{-- <h1>
                @{{ mensaje }}

            </h1> --}}
            {{-- <div>
                <input type="file" ref="fileInput" accept=".xls, .xlsx">
                <button @click="importarUsuarios">Importar Usuarios</button>
              
            </div> --}}
            {{-- vista 0 --}}
            <div class="row" v-show="principal==0">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Ver </h3>
                            <p>Licenciaturas</p>
                        </div>
                        <div class="icon">
                            <i class="fa-regular fa-eye"></i>
                        </div>
                        <a class="small-box-footer" @click="vista1()">Ver más <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>Agregar</h3>
                            <p>RVOES</p>
                        </div>
                        <div class="icon">
                            <i class="fa-solid fa-book"></i>
                        </div>
                        <a class="small-box-footer" @click="verModal()">Ver más <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>


            </div>
            {{-- fin de vista 0 --}}
            {{-- vista 1 --}}
            <div class="row" v-show="principal==1">
                <div class="card col-12" v-for="licenciatura in lisc">
                    <div class="card-body">
                        <div class="card card-danger collapsed-card">
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
                                                        {{-- <th scope="col">Handle</th> --}}
                                                      </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(materia, index) in rvoe.materias" :key="index">
                                                        <th scope="row">@{{ index + 1 }}</th>
                                                        <td>@{{materia.name}}</td>
                                                        <td>@{{materia.materia}}</td>
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
            {{-- fin de vista 1 --}}
            {{-- vista 2 --}}
            <div class="row" v-show="principal==2">
                <h1>vista 2</h1>
            </div>
            {{-- fin de vista 2 --}}
            {{-- modal  --}}
            <div class="modal fade" id="rvoeModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Agregar Rvoe</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-md-6">
                                <h6>Id de RVOE</h6>
                                <input type="text" placeholder="ID RVOE" class="form-control"
                                    v-model="id_rvoe">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <h6>Licenciatura que tendrá este RVOE</h6>
                                <select class="form-control" v-model="licenciatura_rvoe">
                                    <option disabled>Elige una licenciatura</option>
                                    <option v-for="l in licenciaturasObtenidas" :value="l.id_licenciatura">
                                        @{{ l.licenciatura }}</option>
                                </select>
                            </div>
                            
                            
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                            <button type="button" class="btn btn-primary">
                                <i class="fa-solid fa-floppy-disk" @click="guardarRvoe()"></i>
                            </button>

                        </div>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
            {{-- fin de modal  --}}
        </div>
    @else
        <h1>No tienes accesos para este panel</h1>
    @endif

    @push('scripts')
        <script type="module" src="js/apis/apiLicenciaturas.js"></script>
    @endpush
    <input type="hidden" name="route" value="{{url('/')}}">
@endsection
