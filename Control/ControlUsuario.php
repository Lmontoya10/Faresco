<?php 
include('ControlConexion.php');

class ControlUsuario{
    var $objUsuario;

function __construct($objUsuario)
{
    $this->objUsuario = $objUsuario;
}

function consultarUsuario(){

    $correo = $this->objUsuario->getCorreo();
    $clave = $this->objUsuario->getClave();
    var_dump($correo);
    var_dump($clave);

    $objConexion = new ControlConexion();
    $conn = $objConexion->conectar();

    $SP = "{call sp_consultarUsuario( ?, ?)}";

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
            $this->objUsuario->setIdUsuario(sqlsrv_get_field($stmt, 0));
            $this->objUsuario->setNombre(sqlsrv_get_field($stmt, 1));
            $this->objUsuario->setCorreo(sqlsrv_get_field($stmt, 2));
            $this->objUsuario->setTipo(sqlsrv_get_field($stmt, 3));
            $this->objUsuario->setClave(sqlsrv_get_field($stmt, 4));
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