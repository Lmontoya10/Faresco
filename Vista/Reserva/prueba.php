<?php
if (isset($_POST['username']) && $_POST['username'] && isset($_POST['password']) && $_POST['password']) {
   
     $msj = "";
        $oper = 'S';
        
        $sede = $_POST['password'];
        
 
        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $SP = "{call sp_consultarEquipo( ?,?,?,?,?,?,?,?,?,?)}";

            $params = array(
                array($oper, SQLSRV_PARAM_IN), array(0, SQLSRV_PARAM_IN), array(0, SQLSRV_PARAM_IN),
                array('', SQLSRV_PARAM_IN), array('', SQLSRV_PARAM_IN), array('', SQLSRV_PARAM_IN),
                array(&$Sede, SQLSRV_PARAM_IN), array('', SQLSRV_PARAM_IN), array('', SQLSRV_PARAM_IN),
                array('', SQLSRV_PARAM_IN)
            );
            $stmt = sqlsrv_query($conn, $SP, $params);

            if ($stmt === false) {
                echo "Error ejecutando sentencia guardar sede.\n";
                die(print_r(sqlsrv_errors(), true));
            } else{
        
                $equipos= array();
        
                while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
                    $equipos[$row['codigo']] = array(
                        'codigo'=> $row['codigo']
                    );
                }
        
            }
            return json_encode($equipos);
    

    
} else {
    echo json_encode(array('success' => 0));
}