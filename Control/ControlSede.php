<?php 
include('ControlConexion.php');

class ControlSede{
    var $objSede;

function __construct($objSede)
{
    $this->objSede = $objSede;
}

function consultarSede(){

    $id = $this->objSede->getId();

    $objConexion = new ControlConexion();
    $conn = $objConexion->conectar();

    $SP = "{call sp_consultarSede( ?)}";

    $params = array(
        array($correo, SQLSRV_PARAM_IN), array(&$clave, SQLSRV_PARAM_IN)
    );

    /* Execute the query. */
    $stmt = sqlsrv_query($conn, $SP, $params);

    if ($stmt === false) {
        echo "Error in executing statement 3.\n";
        die(print_r(sqlsrv_errors(), true));
    }else{

        while (sqlsrv_fetch($stmt)) {
            $this->objUsuario->setIdSede(sqlsrv_get_field($stmt, 0));
            $this->objUsuario->setDescripcion(sqlsrv_get_field($stmt, 1));
            
        }
    }
    //var_dump($this->objUsuario);
   
    /*Free the statement and connection resources. */
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);

    
    return $this->objUsuario;
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
?>