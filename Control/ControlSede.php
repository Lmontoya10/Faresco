<?php 


class ControlSede{
    var $objSede;

function __construct($objSede)
{
    $this->objSede = $objSede;
}

function consultarSedes(){
    $objConexion = new ControlConexion();
    $conn = $objConexion->conectar();
        $oper = 'T';
        $idSede = 0;
        $descripcion = '';
        $usuario ='';
        $FechaIn= '';
    $SP = "{call ps_sede(?,?,?,?,?)}";
    $params = array(
        array($oper, SQLSRV_PARAM_IN), array(&$idSede, SQLSRV_PARAM_IN), array(&$descripcion, SQLSRV_PARAM_IN),
        array(&$usuario, SQLSRV_PARAM_IN), array(&$FechaIn, SQLSRV_PARAM_IN)
    );
    $stmt = sqlsrv_query($conn, $SP, $params);

    if ($stmt === false) {
        echo "Error ejecutando sentencia guardar sede.\n";
        die(print_r(sqlsrv_errors(), true));
    } else{
        $sede=array();
        $sedes= array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

            $sede[] = $row['idSede'];
            $sede[] = $row['descripcion'];
           $sedes[]=$sede;
        }

    }
   
return $sedes;
}

function consultarSede(){

    $oper='U';
    $id = $this->objSede->getId();
    $descripcion = $this->objSede->getDescripcion();
    $usuario='';
    $fecha = '';


    $objConexion = new ControlConexion();
    $conn = $objConexion->conectar();

    $SP = "{call ps_sede( ?,?,?,?,?)}";

    $params = array(
        array($oper, SQLSRV_PARAM_IN),
        array(&$id, SQLSRV_PARAM_IN), 
        array(&$descripcion, SQLSRV_PARAM_IN),
        array(&$usuario, SQLSRV_PARAM_IN),
        array(&$fecha, SQLSRV_PARAM_IN),
    );

    /* Execute the query. */
    $stmt = sqlsrv_query($conn, $SP, $params);

    if ($stmt === false) {
        echo "Error in executing statement 3.\n";
        die(print_r(sqlsrv_errors(), true));
    }else{

        while (sqlsrv_fetch($stmt)) {
            $this->objSede->setId(sqlsrv_get_field($stmt, 0));
            $this->objSede->setDescripcion(sqlsrv_get_field($stmt, 1));
            
        }
    }
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    return $this->objSede;
}

function guardarSede()
    {
        //SE RECOGEN LOS DATOS DEL OBJETO
        $msj = "";
        $oper = 'I';
        $idSede = $this->objSede->getId();
        $descripcion = $this->objSede->getDescripcion();
        $usuario = $this->objSede->getUsuario();
        $FechaIn= $this->objSede->getFechaCrea();

        //se comprueba que el equipo no este registrado
        // if ($this->existencia($C) == true) {
        //     $msj = "ojo";
        // } else {}
            $objConexion = new ControlConexion();
            $conn = $objConexion->conectar();

            $SP = "{call ps_sede(?,?,?,?,?)}";

            $params = array(
                array($oper, SQLSRV_PARAM_IN), array(&$idSede, SQLSRV_PARAM_IN), array(&$descripcion, SQLSRV_PARAM_IN),
                array(&$usuario, SQLSRV_PARAM_IN), array(&$FechaIn, SQLSRV_PARAM_IN)
            );

            /* ejecuta la consulta. */
            $stmt = sqlsrv_query($conn, $SP, $params);

            if ($stmt === false) {
                echo "Error ejecutando sentencia guardar sede.\n";
                die(print_r(sqlsrv_errors(), true));
            } else {
                $msj = "ok";
            }
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);
        

        return $msj;
    }


}
