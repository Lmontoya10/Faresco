<?php
error_reporting(E_ALL ^ E_NOTICE);

session_start();
include("Modelo/Usuario.php");
include("Control/ControlUsuario.php");


if (isset($_POST['boton'])) {
    $bot = $_POST['boton'];
    /*     $data = array(
        'coreo'=> $_SESSION['correo'],
        'clave'=> $_SESSION['password']
    );
    echo"<pre>";
    print_r($data);
    echo"</pre>";
    die();
 */
$_SESSION['correo'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];
}



if (!empty($bot) && $bot == "logout") {
    $objUsuario = new Usuario("","", $_SESSION['correo'], "", $_SESSION['password'],"", "");
    $objCrtUsuario = new ControlUsuario($objUsuario);
    $objU = $objCrtUsuario->consultarUsuario();
    $id = $objU->getIdUsuario();
    $tipo = $objU->getRol();
}



?>
<style>
    .btn-block {
        background-color: #7a268f !important;
    }

    .tarjeta {
        margin-top: 100px;
    }

    .title {
        color: #7a268f;
    }

    #password::placeholder {
        color: #7a268f;
    }

    #email::placeholder {
        color: #7a268f;
    }

    #email,
    #password {
        color: #7a268f;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.css" />
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.0/sweetalert2.js"></script>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="estilo/myStyle.css" rel="stylesheet" type="text/css">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="my-accordion" id="my-accordion">

    <?php if (!empty($bot) && $bot == "logout") {
        if (empty($id)) { ?>
            <script>
                function alerta() {
                    swal({
                        title: "¡ERROR!",
                        text: "Datos incorrectos..verificar!",
                        type: "error",
                    });
                }
                alerta();
            </script>
        <?php } elseif ($tipo != "1" && $tipo != "2") { ?>
            <script>
                function alerta() {
                    swal({
                        title: "¡Oops...!",
                        text: "No tienes autorizacion de ingreso, contacte administrador!",
                        type: "error",
                    });
                }
                alerta();
            </script>
    <?php } else {

            $_SESSION['idUsuario'] = $objU->getIdUsuario();
            $_SESSION['nombre'] = $objU->getNombre();
            $_SESSION['rolUsuario'] = $objU->getRol();

            header("Status: 301 Moved Permanently");
            header("Location: home.php");
            exit;
        }
    } ?>

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9 tarjeta">

                <div class="card o-hidden border-0 shadow-lg my-5 " style="border-radius: 20px 143px 20px 143px;">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block text-center">
                                <div class="p-3">
                                    <img src="img/logo1.png" alt="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-primary-900 mb-4 title"> Bienvenido a <strong>Faresco</strong></h1>
                                    </div>
                                    <form class="user" method="POST" action="index.php">
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email" aria-describedby="emailHelp" name="email" placeholder="Enter Email Address..." required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" placeholder="password" name="password" required>
                                        </div>
                                        <input type="submit" class="btn btn-user btn-block" name="boton" value="logout">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>