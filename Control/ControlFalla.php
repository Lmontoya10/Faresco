<?php
include("ControlConexion.php");

class ControlFalla
{
    var $objFalla;

    function __construct($objFalla)
    {
        $this->objFalla = $objFalla;
    }

    function GuardarFalla()
    {
        $msj = "";
        $oper = 'I';
        $id = 0;
        $idReserva = $this->objFalla->getIdReserva();
        $falla = $this->objFalla->getFalla();
        $solucion = $this->objFalla->getSolucion();
        $usuarioFalla = $this->objFalla->getUsuarioFalla();
        $usuarioSol = $this->objFalla->getUsuarioSol();
        $fechaFalla = date("Y-m-d");
        $fechaSol = $this->objFalla->getFechaSol();

        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $SP = "{call sp_RegistrarFalla( ?, ?, ?, ?, ?, ?, ?, ?, ?)}";

        $params = array(
            array($oper, SQLSRV_PARAM_IN), array(&$id, SQLSRV_PARAM_IN), array(&$idReserva, SQLSRV_PARAM_IN),
            array(&$falla, SQLSRV_PARAM_IN), array(&$solucion, SQLSRV_PARAM_IN), array(&$usuarioFalla, SQLSRV_PARAM_IN),
            array(&$usuarioSol, SQLSRV_PARAM_IN), array(&$fechaFalla, SQLSRV_PARAM_IN), array(&$fechaSol, SQLSRV_PARAM_IN),
        );

        $stmt = sqlsrv_query($conn, $SP, $params);

        if ($stmt === false) {
            echo "Error ejecutando sentencia guardar falla.\n";
            die(print_r(sqlsrv_errors(), true));
        } else {
            $msj = "ok";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);

        return $msj;
    }

    function ConsultarFallasPendientes()
    {
        $oper = 'P';
        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $SP = "{call sp_ConsultarFallas( ?, ?)}";

        $params = array(
            array($oper, SQLSRV_PARAM_IN), array(0, SQLSRV_PARAM_IN)
        );

        $stmt = sqlsrv_query($conn, $SP, $params);

        if ($stmt === false) {
            echo "Error ejecutando consulta.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        $reservas = array();

        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

            $reservas[] = array(
                'idFalla' => $row['Id'],
                'idReserva' => $row['idReserva'],
                'idEquipo' => $row['idEquipo'],
                'sede' => $row['sede'],
                'Falla' => $row['Falla'],
                'Usuario' => $row['correoUsuario']
            );
        }



        return $reservas;
    }
    function GuardarSolucion()
    {
        $msj = "";
        $oper = 'S';
        $id = $this->objFalla->getId();
        $solucion = $this->objFalla->getSolucion();
        $usuarioSol = $this->objFalla->getUsuarioSol();
        $fechaSol = date("Y-m-d");

        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $SP = "{call sp_RegistrarFalla( ?, ?, ?, ?, ?, ?, ?, ?, ?)}";

        $params = array(
            array($oper, SQLSRV_PARAM_IN), array(&$id, SQLSRV_PARAM_IN), array(0, SQLSRV_PARAM_IN),
            array('', SQLSRV_PARAM_IN), array(&$solucion, SQLSRV_PARAM_IN), array(0, SQLSRV_PARAM_IN),
            array(&$usuarioSol, SQLSRV_PARAM_IN), array('', SQLSRV_PARAM_IN), array(&$fechaSol, SQLSRV_PARAM_IN),
        );


        /* ejecuta la consulta. */
        $stmt = sqlsrv_query($conn, $SP, $params);

        if ($stmt === false) {
            echo "Error ejecutando sentencia guardar falla.\n";
            die(print_r(sqlsrv_errors(), true));
        } else {
            $msj = "ok";
        }
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);

        return $msj;
    }
}
