<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();

include("../../Modelo/Equipo.php");
include("../../Modelo/Reserva.php");
include("../../Control/ControlReserva.php");
include("../../Control/ControlEquipo.php");

date_default_timezone_set("America/Bogota");
$HoraActual = date("G");  // Hora actual en 24 hrs del País
$fcha = date("Y-m-d");

$bot = $_POST['Boton'];
$id = $_POST['id'];
$FechaRes = $_POST['Fecha'];
$HoraIni = $_POST['HoraIni'];
$HoraFin = $_POST['HoraFin'];
$Equipo = $_POST['Equipo'];
$FechaReg = date("Y-m-d");
$Usuario = $_SESSION['idUsuario'];
$estad = $_POST['Estado'];

try {
    if ($bot == "Consultar") {
        $objReserva = new Reserva($id, '', '', '', '', '', '', '','');
        $objCtrReserva = new ControlReserva($objReserva);
        $objRes = $objCtrReserva->consultarReserva(); 
        if(!empty($objRes->getFechaRes())){
            $idRe = $objRes->getIdReserva();
            $usuario = $objRes->getUsuario();
            $Equipo = $objRes->getEquipo();
            $fechaRes = $objRes->getFechaRes();
            $horaI = $objRes->getHoraIni()->format('H:i');
            $horaF = $objRes->getHoraFin()->format('H:i');
            $fechaReg = $objRes->getFechaReg();
            $est = $objRes->getEstado();
            $sede = $objRes->getSede();
       

            switch ($est) {
                case "A":
                    $estado = "ACTIVA";
                    break;
                case "C":
                    $estado= "CANCELADA";
                    break;
                case "E":
                    $estado = "EN USO";
                    break;
                case "S":
                    $estado = "ANULADA";
                    break;
                case "U":
                    $estado = "CERRADA";
                    break;
            }
        }
    } elseif ($bot == "Modificar Reserva") {
     
            $objReserva = new Reserva($id, $FechaRes, $HoraIni, $HoraFin, $FechaReg, $Equipo, $Usuario, $estad,$Sede);
            $objCtrReserva = new ControlReserva($objReserva);
            $msj = $objCtrReserva->actualizarReserva();
    }
} catch (Exception $objExp) {
    echo 'Se presentó una excepción: ', $objExp->getMessage(), '\n';
}
isset($_SESSION['correo'])  ? $_SESSION['correo'] : header('Location: ../../index.php');
isset($_SESSION['password']) ? $_SESSION['password'] : header('Location: ../../index.php');
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Modificar Reserva</title>
    <!-- ALERTAS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.js"></script>

</head>

<body id="page-top">
    <?php  if(empty($fechaRes) && $bot == "Consultar"){ ?>
            <script>
                alerta();
                function alerta() {
                    swal({
                        title: "Oops...",
                        text: "No existe la reserva <?php echo $id ?>!",
                        type: "warning",
                    });
                }
            </script>
        <?php } elseif($est != "A" && $bot == "Consultar" ) { ?>
            <script>
                alerta1();
                function alerta1() {
                    swal({
                        title: "Oops...",
                        text: "No se puede modificar reserva por <?php echo $estado ?>!",
                        type: "warning",
                    });
                }
            </script>
        <?php }elseif ($msj !="" && $bot == "Modificar Reserva") { ?>
        <script>
            alerta2();

            function alerta2() {
                swal({
                    title: "Bien hecho...",
                    text: "Se modifico la reserva <?php echo $msj ?>",
                    type: "success",
                });
            }
        </script>
    <?php } elseif (empty($msj) && $bot == "Modificar Reserva") { ?>
        <script>
            alerta3();

            function alerta3() {
                swal({
                    title: "Oops...",
                    text: "Algo salio mal..!",
                    type: "error",
                });
            }
        </script>
    <?php } ?>

    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../../home.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Faresco</sup></div>
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
                    <span>Equipo</span>
                </a>
                <div id="collapseEqui" class="collapse" aria-labelledby="headingEqui" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Equipo</h6>
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
                        <a class="collapse-item" href="registrarReserva.php">Registrar</a>
                        <a class="collapse-item" href="consultarReserva.php">Consultar</a>
                    </div>
                </div>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Nav Item - Charts -->
            <li class="nav-item ">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMan" aria-expanded="true" aria-controls="collapseMan">
                    <i class="fas fa-fw fa-ambulance"></i>
                    <span>Fallas</span>
                </a>
                <div id="collapseMan" class="collapse" aria-labelledby="headingMan" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Menu Fallas:</h6>
                        <a class="collapse-item" href="../Mantenimiento/registroMantenimiento.php">Registrar</a>
                        <a class="collapse-item" href="..Mantenimiento/registroMantenimiento.php">Solucionar</a>
                        <a class="collapse-item" href="../Mantenimiento/consultarMantenimiento.php">Consultar</a>
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
                <nav class="navbar navbar-expand navbar-light bg-dark topbar mb-4 static-top shadow">

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

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
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
                                            <?php if ($bot == "Consultar" && $est == "A") { ?>
                                                <h1 class="h4 text-gray-900 mb-4">Modificar Reserva</h1>
                                            <?php } else { ?>
                                                <h1 class="h4 text-gray-900 mb-4">Reserva a Modificar</h1>
                                            <?php } ?>
                                        </div>
                                        <form class="user" method="Post" action="modificarReserva.php">
                                            <?php if ($bot == "Consultar" && $est == "A") { ?>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="">Nro Reserva</label>
                                                        <input type="text" class="form-control form-control-user" id="id" name="id" value="<?php echo $idRe; ?>" readonly>
                                                    </div>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="">Fecha Reserva</label>
                                                        <input type="date" class="form-control form-control-user" id="Fecha" name="Fecha" value="<?php echo $fechaRes; ?>" onchange="diaSemana();">
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="">Hora Inicio</label>
                                                        <input type="time" id="HoraIni" name='HoraIni' class="form-control form-control-user" value="<?php echo $horaI; ?>" onchange="horas();">

                                                    </div>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label for="">Hora Fin</label>
                                                        <input type="time" id="HoraFin" name='HoraFin' class="form-control form-control-user" value="<?php echo $horaF; ?>" onchange="diaSemana(); dias();">

                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label>Equipo</label>
                                                        <input id="Equipo" name='Equipo' class="form-control form-control-user" value="<?php echo $Equipo; ?>">
                                                    </div>
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label>Estado</label>
                                                        <select name='Estado' id="Equipo" class="form-control form-control-select">
                                                            <option value="<?php echo $est; ?>" selected><?php echo $estado; ?></option>
                                                            <option value="C">Cancelar</option>
                                                            <option value="E">En Uso</option>
                                                            <option value="S">Anular</option>
                                                            <option value="U">Cerrar</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <label>Sede</label>
                                                        <input id="Sede" name='Sede' class="form-control form-control-user" value="<?php echo $sede; ?>">
                                                    </div>
                                                    
                                                </div>
                                                <input type="submit" class="btn btn-success btn-user btn-block" name="Boton" value="Modificar Reserva">
                                                <script type="text/javascript">
                                                    function diaSemana() {
                                                        var Fa = new Date();
                                                        var Fr = document.getElementById("Fecha");
                                                        var hf = document.getElementById("HoraFin").value;
                                                        if (Fr.valueAsDate.getDay() == 6) alertaf(te="El día DOMINGO no se labora");
                                                        if (Fa.getDate() > (Fr.valueAsDate.getDate() + 1)) alertaf(te="la fecha reserva debe ser mayor o igual a la actual");
                                                        if (Fr.valueAsDate.getDay() == 5 && hf > "12:00") alertaf(te="El día SABADO horario hasta las 12:00");
                                                        if (Fr.valueAsDate.getDay() != 5 && hf > "18:00") alertaf(te="la hora final debe ser menor o igual a 18:00");
                                                    }

                                                    function dias() {
                                                        var Fa = new Date();
                                                        var Fr = document.getElementById("Fecha");
                                                        var hf = document.getElementById("HoraFin").value;
                                                        var hi = document.getElementById("HoraIni").value;
                                                        if (Fa.getDate() == (Fr.valueAsDate.getDate() + 1) && parseInt(hi) < Fa.getHours()) alertaf(te="la hora debe ser mayor a la actual");
                                                        if (hf <= hi) alertaf(te="La hora inicial no puede ser mayor o igual a la final");
                                                    }

                                                    function horas() {
                                                        var Fa = new Date();
                                                        var Fr = document.getElementById("Fecha");
                                                        var hi = document.getElementById("HoraIni").value;
                                                        if (hi < "07:00") alertaf(te="la hora inicial debe ser mayor o igual a las 07:00");
                                                        if (Fr.valueAsDate.getDay() == 5 && hi > "11:30") alertaf(te="El dia Sabado la hora minima es 11:30");
                                                        if (Fr.valueAsDate.getDay() != 5 && hi > "17:30") alertaf(te="la hora minima es hasta las 17:30");
                                                    }

                                                    function alertaf(te) {
                                                        swal({
                                                            title: "Oops...",
                                                            text: te+"!",
                                                            type: "error",
                                                        });
                                                    }
                                                </script>
                                            <?php } else { ?>
                                                <div class="form-group row">
                                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                                        <input type="number" class="form-control form-control-user" id="id" name="id" min="0" placeholder="Nro Reserva" required>
                                                    </div>
                                                </div>
                                                <input type="submit" class="btn btn-primary btn-user btn-block" name="Boton" value="Consultar">
                                            <?php } ?>
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
                    <h5 class="modal-title" id="exampleModalLabel">Cerrar Session</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body"><?php echo $_SESSION['nombre'] ?> desea cerrar session ?</div>
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