<?php
include('../../library/phpqrcode/qrlib.php');

class controlReserva
{

    var $objReserva;

    function __construct($objReserva)
    {
        $this->objReserva = $objReserva;
    }

    function GuardarReserva()
    {
        $msj = "";
        $oper = "I";
        $idR = $this->objReserva->getIdReserva();
        $FechaRes = $this->objReserva->getFechaRes();
        $HoraIni = $this->objReserva->getHoraIni();
        $HoraFin = $this->objReserva->getHoraFin();
        $FechaReg = $this->objReserva->getFechaReg();
        $Sede = $this->objReserva->getSede();
        $equipo = $this->objReserva->getEquipo();
        $Usuario = $this->objReserva->getUsuario();
        $Estado = $this->objReserva->getEstado();


        // $equipo = $this->disponibles($FechaRes, $HoraFin, $HoraIni);
        // $cod = $equipo->codigo;


        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $SP = "{call sp_Reserva( ?, ?, ?, ?, ?, ?, ?, ?, ?,?)}";

        $params = array(
            array($oper, SQLSRV_PARAM_IN), array(&$idR, SQLSRV_PARAM_IN),
            array(&$Usuario, SQLSRV_PARAM_IN), array(&$equipo, SQLSRV_PARAM_IN),
            array(&$FechaRes, SQLSRV_PARAM_IN), array(&$HoraIni, SQLSRV_PARAM_IN),
            array(&$HoraFin, SQLSRV_PARAM_IN), array(&$FechaReg, SQLSRV_PARAM_IN),
            array(&$Estado, SQLSRV_PARAM_IN), array(&$Sede, SQLSRV_PARAM_IN)
        );

        /* Execute the query. */
        $stmt = sqlsrv_query($conn, $SP, $params);

        if ($stmt === false) {
            echo "Error ejecutando sentencia guardar reserva .\n";
            die(print_r(sqlsrv_errors(), true));
        } else {

            //SE SACA EL NUMERO DE LA RESERVA
            while (sqlsrv_fetch($stmt)) {
                $numeroR =  sqlsrv_get_field($stmt, 0);
            }
            // $_SESSION['numeroR'] = $numeroR;
            // //RUTA DE LA CARPETA Y NORMBRE DE CODIGO
            // $codesDir = "ImgCodigos/"; //nombre de la carpeta
            // $codeFile = date('d-m-Y-h-i-s') . '.png'; //nombre de del QR

            // if (!file_exists($codesDir)) {
            //     mkdir($codesDir);
            // }

            // $nombre = $_SESSION['nombre'];
            // //SE EL PASAN LOS PARAMETROS A LA CLASE QR, DATOS A  MOSTRAR Y RURA DE LA CARPETA.
            // QRcode::png("Datos Reserva:
            // Numero: $numeroR
            // Fecha: $FechaRes 
            // Inicia: $HoraIni 
            // Hasta: $HoraFin
            // Equipo: $equipo
            // Nombre: $nombre", $codesDir . $codeFile, 'H', '5');

            // $msj = $codesDir . $codeFile;

            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);
        }
        return $numeroR;
    }

    function consultarReserva()
    {
        $idR = $this->objReserva->getIdReserva();
        $oper = "S";

        try {
            $objConexion = new ControlConexion();
            $conn = $objConexion->conectar();

            $SP = "{call sp_Reserva( ?, ?, ?,?,?,?,?,?,?,?)}";

            $params = array(
                array($oper, SQLSRV_PARAM_IN),
                array(&$idR, SQLSRV_PARAM_IN), array(0, SQLSRV_PARAM_IN),
                array(0, SQLSRV_PARAM_IN), array("", SQLSRV_PARAM_IN),
                array("", SQLSRV_PARAM_IN), array("", SQLSRV_PARAM_IN),
                array("", SQLSRV_PARAM_IN), array("", SQLSRV_PARAM_IN),
                array(0, SQLSRV_PARAM_IN)
            );

            /* Execute the query. */
            $stmt = sqlsrv_query($conn, $SP, $params);

            if ($stmt === false) {
                echo "Error ejecutando consulta.\n";
                die(print_r(sqlsrv_errors(), true));
            }
            while (sqlsrv_fetch($stmt)) {

                $this->objReserva->setIdReserva(sqlsrv_get_field($stmt, 0));
                $this->objReserva->setUsuario(sqlsrv_get_field($stmt, 1));
                $this->objReserva->setEquipo(sqlsrv_get_field($stmt, 2));
                $this->objReserva->setFechaRes(sqlsrv_get_field($stmt, 3));
                $this->objReserva->setHoraIni(sqlsrv_get_field($stmt, 4));
                $this->objReserva->setHorafin(sqlsrv_get_field($stmt, 5));
                $this->objReserva->setFechaReg(sqlsrv_get_field($stmt, 6));
                $this->objReserva->setEstado(sqlsrv_get_field($stmt, 7));
                $this->objReserva->setSede(sqlsrv_get_field($stmt, 8));
            }

            /*Free the statement and connection resources. */
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);
        } catch (Exception $e) {
            echo "ERROR " . $e->getMessage() . "\n";
        }

        return $this->objReserva;
    }

    function reservaEquipo()
    {
        $eId = $this->objReserva->getEquipo();
        $oper = "R";

        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $SP = "{call sp_consultarReserva( ?, ?, ?)}";

        $params = array(
            array($oper, SQLSRV_PARAM_IN), array("", SQLSRV_PARAM_IN),
            array(&$eId, SQLSRV_PARAM_IN)
        );

        /* Execute the query. */
        $stmt = sqlsrv_query($conn, $SP, $params);
        if ($stmt === false) {
            echo "Error in executing statement 3.\n";
            die(print_r(sqlsrv_errors(), true));
        }
        while (sqlsrv_fetch($stmt)) {

            $this->objReserva->setIdReserva(sqlsrv_get_field($stmt, 0));
        }
        return $this->objReserva;
    }

    function cancelarReserva()
    {
        $msj = "";
        $oper = "C";
        $idR = $this->objReserva->getIdReserva();
        $estado = $this->objReserva->getEstado();

        try {
            $objConexion = new ControlConexion();
            $conn = $objConexion->conectar();

            $SP = "{call sp_Reserva( ?, ?, ?, ?, ?, ?, ?, ?, ?,?)}";

            $params = array(
                array($oper, SQLSRV_PARAM_IN),
                array(&$idR, SQLSRV_PARAM_IN), array(0, SQLSRV_PARAM_IN),
                array(0, SQLSRV_PARAM_IN), array("", SQLSRV_PARAM_IN),
                array("", SQLSRV_PARAM_IN), array("", SQLSRV_PARAM_IN),
                array("", SQLSRV_PARAM_IN), array(&$estado, SQLSRV_PARAM_IN),
                array(0, SQLSRV_PARAM_IN)
            );

            /* Execute the query. */
            $stmt3 = sqlsrv_query($conn, $SP, $params);

            if ($stmt3 === false) {
                echo "Error ejecutando sentencia cancelar reserva.\n";
                die(print_r(sqlsrv_errors(), true));
            } else {
                $msj = "ok";
            }
        } catch (Exception $objExp) {
            echo $objExp->getMessage();
            die();
        }
        return $msj;
    }

    function actualizarReserva()
    {
        $msj = "";
        $oper = "A";
        $idR = $this->objReserva->getIdReserva();
        $FechaRes = $this->objReserva->getFechaRes();
        $HoraIni = $this->objReserva->getHoraIni();
        $HoraFin = $this->objReserva->getHoraFin();
        $Equipo = $this->objReserva->getEquipo();;
        $estado = $this->objReserva->getEstado();
        $Sede = $this->objReserva->getSede();
        try {
            $objConexion = new ControlConexion();
            $conn = $objConexion->conectar();

            $SP = "{call sp_Reserva( ?, ?, ?, ?, ?, ?, ?, ?, ?,?)}";

            $params = array(
                array($oper, SQLSRV_PARAM_IN), array(&$idR, SQLSRV_PARAM_IN),
                array(&$Usuario, SQLSRV_PARAM_IN), array(&$Equipo, SQLSRV_PARAM_IN),
                array(&$FechaRes, SQLSRV_PARAM_IN), array(&$HoraIni, SQLSRV_PARAM_IN),
                array(&$HoraFin, SQLSRV_PARAM_IN), array(&$FechaReg, SQLSRV_PARAM_IN),
                array(&$estado, SQLSRV_PARAM_IN), array(&$Sede, SQLSRV_PARAM_IN)
            );

            /* Execute the query. */
            $stmt = sqlsrv_query($conn, $SP, $params);

            if ($stmt === false) {
                echo "Error ejecutando sentencia actualizar reserva.\n";
                die(print_r(sqlsrv_errors(), true));
            } else {
                $msj = "$idR Fecha: $FechaRes desde: $HoraIni hasta: $HoraFin";
            }
        } catch (Exception $objExp) {
            echo $objExp->getMessage();
            die();
        }
        return $msj;
    }

    public function disponibles($fr, $hf, $hi)
    {

        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $SP = "{call sp_equiposDisponibles( ?, ?, ?)}";

        $params = array(array($fr, SQLSRV_PARAM_IN), array(&$hi, SQLSRV_PARAM_IN), array(&$hf, SQLSRV_PARAM_IN));

        /* Execute the query. */
        $stmt = sqlsrv_query($conn, $SP, $params);

        if ($stmt === false) {
            echo "Error ejecutando la sentencia equipos disponibles.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        $equipo = new stdClass();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_SCROLL_NEXT)) {

            $equipo->id = $row[0];
            $equipo->codigo = $row[1];
        }

        /*Free the statement and connection resources. */
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);


        return $equipo;
    }

    }
