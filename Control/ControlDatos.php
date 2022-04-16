<?php
include('ControlConexion.php');

class ControlDatos
{

    function equiposActivos()
    {
        $contE=0;

        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $sql = "{call sp_equiposActivos()}";

        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            die(print_r(sqlsrv_errors(), true));

        }else{
            while (sqlsrv_fetch($stmt)) {
                $contE ++;
            }
        }
        
        return $contE;
    }

    function reservasPendientes()
    {
        $cantPen = 0;

        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $sql = "{call sp_reservasPendientes()}";

        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            echo "Error in executing statement \n";
            die(print_r(sqlsrv_errors(), true));

        } else {
            while (sqlsrv_fetch($stmt)) {
                $cantPen ++;
            }
        }
        return $cantPen;
    }

    function devolucionPendientes()
    {
        $cantDev = 0;

        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $SP = "{call sp_devolucionPendientes()}";

        $stmt = sqlsrv_query($conn, $SP);

        if ($stmt === false) {
            echo "Error in executing statement \n";
            die(print_r(sqlsrv_errors(), true));

        } else {
            while (sqlsrv_fetch($stmt)) {
                $cantDev ++;
            }
        }

        return $cantDev;
    }

    function equiposReservados(){
        $cantEr = 0;

        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $SP = "{call sp_equiposReservados()}";

        $stmt = sqlsrv_query($conn, $SP);

        if ($stmt === false) {
            echo "Error in executing statement \n";
            die(print_r(sqlsrv_errors(), true));

        } else {
            while (sqlsrv_fetch($stmt)) {
                $cantEr ++;
            }
        }

        return $cantEr;
    }
}
