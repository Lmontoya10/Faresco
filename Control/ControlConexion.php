<?php

class ControlConexion{
	var $conn;
	
	function __construct(){
		$this->conn = null;
	}
	
    function conectar(){

		//Parámetros de conexión al SQL Server
        $serverName = "PAARQUITECTURA";
        $connection = array("Database" => "Faresco");

        //Establecimiento de la Conexión
        $conn = sqlsrv_connect($serverName, $connection);
        if ($conn === false) {
            die(FormatErrors(sqlsrv_errors()));
        }
       
		return $conn;
    	
    }
}
?>
