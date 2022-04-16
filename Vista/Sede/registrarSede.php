<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
include("../../Modelo/Sede.php");
include("../../Control/ControlSede.php");
/*$bot = $_POST['Boton'];
$descripcion = $_POST['descripcion'];
$fechaRe = date("Y-m-d");
$usuario = $_SESSION['idUsuario'];

try {
    if ($bot == "Guardar") {
        $objSede = new Sede("", $descripcion, $fechaRe, $usuario);
        $objCtrSede = new ControlSede($objSede);
        $msj = $objCtrEquipo->guardarEquipo();
    }
} catch (Exception $objExp) {
    echo 'Se presentó una excepción: ', $objExp->getMessage(), '\n';
}
isset($_SESSION['correo'])  ? $_SESSION['correo'] : header('Location: ../../index.php');
isset($_SESSION['clave']) ? $_SESSION['clave'] : header('Location: ../../index.php');
*/ 

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Registrar Sede</title>

    <!-- ALERTAS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

    <!-- Custom fonts for this template-->

    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <link href="../../estilo/myStyle.css" rel="stylesheet">

    <script src="dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="dist/sweetalert.css">



</head>

<body id="page-top">
    <?php if (isset($msj)) {
        if ($msj == "ok") { ?>
            <script>
                alerta();

                function alerta() {
                    swal({
                        title: "Bien hecho...",
                        text: "Registro Exitoso!",
                        type: "success",
                    });
                }
            </script>
        <?php } elseif ($msj == "ojo") { ?>
            <script>
                alerta1();

                function alerta1() {
                    swal({
                        title: "Oops...",
                        text: " Sede ya registrada!",
                        type: "warning",
                    });
                }
            </script>
        <?php } else { ?>
            <script>
                alerta2();

                function alerta2() {
                    swal({
                        title: "Oops...",
                        text: "Algo salio mal!",
                        type: "error",
                    });
                }
            </script>

    <?php  }
    } ?>
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">FARESCO</sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../../home.php">
                    <i class="fas fa-home "></i>
                    <span>Home</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu Equipos-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEqui" aria-expanded="true" aria-controls="collapseEqui">
                    <i class="fas fa-laptop fa-cog"></i>
                    <span>Sedes</span>
                </a>
                <div id="collapseEqui" class="collapse" aria-labelledby="headingEqui" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Sede</h6>
                        <a class="collapse-item" href="../Sede/consultarSede.php">Consultar</a>
                        <a class="collapse-item" href="../Sede/modificarSede.php">Modificar</a>
                    </div>
                </div>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReser" aria-expanded="true" aria-controls="collapseReser">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Equipo</span>
                </a>
                <div id="collapseReser" class="collapse" aria-labelledby="headingReser" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Reserva:</h6>
                        <a class="collapse-item" href="../Equipo/registrarEquipo.php">Registrar</a>
                        <a class="collapse-item" href="../Equipo/consultarEquipo.php">Consultar</a>
                        <a class="collapse-item" href="../Equipo/modificarEquipo.php">Modificar</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseReser" aria-expanded="true" aria-controls="collapseReser">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Reserva</span>
                </a>
                <div id="collapseReser" class="collapse" aria-labelledby="headingReser" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Reserva:</h6>
                        <a class="collapse-item" href="../Reserva/registrarReserva.php">Registrar</a>
                        <a class="collapse-item" href="../Reserva/consultarReserva.php">Consultar</a>
                        <a class="collapse-item" href="../Reserva/modificarReserva.php">Modificar</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Pages Collapse Menu ENTREGA-->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseEntre" aria-expanded="true" aria-controls="collapseEntre">
                    <i class="fas fa-fw fa-hand-holding"></i>
                    <span>Entrega</span>
                </a>
                <div id="collapseEntre" class="collapse" aria-labelledby="headingEntre" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Entrega:</h6>
                        <a class="collapse-item" href="../Entrega/registrarEntrega.php">Registrar</a>
                        <a class="collapse-item" href="../Entrega/consultarEntrega.php">Consultar</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - MENU DEVOLUCION -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseDevl" aria-expanded="true" aria-controls="collapseDevl">
                    <i class="fas fa-fw fa-vote-yea"></i>
                    <span>Devolución</span>
                </a>
                <div id="collapseDevl" class="collapse" aria-labelledby="headingDevl" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Devolución:</h6>
                        <a class="collapse-item" href="../Devolucion/registrarDevolucion.php">Registrar</a>
                        <a class="collapse-item" href="../Devolucion/consultarDevolucion.php">Consultar</a>
                        <a class="collapse-item" href="../Devolucion/modificarDevolucion.php">Modificar</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMan" aria-expanded="true" aria-controls="collapseMan">
                    <i class="fas fa-fw fa-ambulance"></i>
                    <span>Mantenimiento</span>
                </a>
                <div id="collapseMan" class="collapse" aria-labelledby="headingMan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Mantenimiento:</h6>
                        <a class="collapse-item" href="../Mantenimiento/registroMantenimiento.php">Ingreso</a>
                        <a class="collapse-item" href="../Mantenimiento/salidaMantenimiento.php">Salida</a>
                        <a class="collapse-item" href="../Mantenimiento/consultarMantenimiento.php">Consultar Entrada</a>
                        <a class="collapse-item" href="../Mantenimiento/modificarMantenimiento.php">Modificar Entrada</a>
                        <a class="collapse-item" href="../Mantenimiento/ConsultarSalida.php">Consultar Salida</a>
                        <a class="collapse-item" href="../Mantenimiento/modificarSalida.php">Modificar Salida</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow" id="navbar-style">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-white small"><?php echo $_SESSION['nombre'] ?></span>
                                <img class="img-profile rounded-circle" src="../../img/avatar.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configuracion
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Salir
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- CONTENIDO -->
                <div class="container-fluid">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-2">
                                </div>
                                <div class="col-lg-8">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Registrar Sede</h1>
                                        </div>
                                        <form class="user" method="Post" action="registrarSede.php">
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="text" class="form-control form-control-user" id="idSede" name="idSede" placeholder="Codigo Sede" readonly>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="text" class="form-control form-control-user" id="Descripcion" name="Descrpicion" placeholder="Nombre Sede" require>
                                                </div>
                                            </div>
                                            <input type="submit" class="btn btn-success btn-user btn-block" name="Boton" value="Guardar">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar Session ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $_SESSION['nombre'] ?> desea cerar session ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../index.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

</body>

</html>