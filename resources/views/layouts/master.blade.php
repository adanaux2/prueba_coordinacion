<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('name') | Dashboard</title>
    {{-- vue 3 --}}
    <script src="https://unpkg.com/vue/dist/vue.global.prod.js"></script>
    {{-- axios --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.26.0/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="css/adminlte.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.1/css/dataTables.dataTables.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="img/logo-azul.png" alt="universidad aztlan" height="150"
                width="140">
        </div>
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    @if (auth()->user()->id_rol == 1)
                        <!-- Código a ejecutar si $condition1 es verdadero -->
                        <a href="admin" class="nav-link">Home</a>
                    @elseif (auth()->user()->id_rol == 2)
                        <!-- Código a ejecutar si $condition1 es falso y $condition2 es verdadero -->
                        <a href="coordinacion" class="nav-link">Home</a>
                    @elseif(auth()->user()->id_rol == 3)
                        <!-- Código a ejecutar si ninguna de las condiciones anteriores es verdadera -->
                        <a href="maestros" class="nav-link">Home</a>
                    @endif

                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->

                <a class="nav-link">{{ auth()->user()->name }}</a>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login.destroy') }}" role="button">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </li>



                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#"
                        role="button">
                        <i class="fas fa-th-large"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-danger elevation-4">
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div>
                    {{-- <div class="image">
                        <img src="img/logo-aztlan.png" width="100">
                    </div> --}}
                    {{-- <div class="info">
                        <a href="#" class="d-block">
                            <img src="img/logo-aztlan.png" width="100">
                        </a>
                    </div> --}}
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                          <img src="img/logo-aztlan.png" class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                          <a href="#" class="d-block">Alexander Pierce</a>
                        </div>
                      </div>
                   
                </div>



                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            @if (auth()->user()->id_rol == 2)
                                <!-- Código a ejecutar si $condition1 es verdadero -->
                                <ul class="nav nav-treeview">
                                    <li class="nav-item">
                                        <a href="coordinacion_maestros" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>1. Maestros</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="licenciaturas" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>2. Licenciaturas y RVOES</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="mate" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>3. Subir materias</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="asignacion" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>4. Crear grupos</p>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="asignar" class="nav-link">
                                            <i class="far fa-circle nav-icon"></i>
                                            <p>5. Asignar</p>
                                        </a>
                                    </li>
                                </ul>
                            @endif
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            @yield('content')
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->


        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <strong>Copyright &copy; 2024-2025 <a href="https://universidadaztlan.edu.mx">Universidad
                    Aztlán</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.1.1
            </div>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
           
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <script src="js/bootstrap.bundle.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.1/js/dataTables.js"></script>

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- muy importantes para la pagina -->
    <!-- AdminLTE App -->
    <script src="js/adminlte.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="js/demo.js"></script>
    <script src="js/summernote-bs4.min.js"></script>
    <script src="js/moment.min.js"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    @stack('scripts')

</body>

</html>
