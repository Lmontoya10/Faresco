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

}
?>