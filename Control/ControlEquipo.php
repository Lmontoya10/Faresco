<?php
include("ControlConexion.php");

class ControlEquipo
{

    var $objEquipo;

    function __construct($objEquipo)
    {
        $this->objEquipo = $objEquipo;
    }

    function guardarEquipo()
    {
        //SE RECOGEN LOS DATOS DEL OBJETO
        $msj = "";
        $oper = 'I';
        $idE = 0;
        $Codigo= $this->objEquipo->getCodigo();
        $Marca = $this->objEquipo->getMarca();
        $Modelo = $this->objEquipo->getModelo();
        $tipo = $this->objEquipo->getTipo();
        $Sede= $this->objEquipo->getSede();
        $Estado = $this->objEquipo->getEstado();
        $FechaRe = $this->objEquipo->getFechaRegistro();
        $Usuario = $this->objEquipo->getUsuario();

        // //se comprueba que el equipo no este registrado
        // if ($this->existencia($CodigoAf) == true) {
        //     $msj = "ojo";
        // } else {}
            $objConexion = new ControlConexion();
            $conn = $objConexion->conectar();

            $SP = "{call Sp_Equipo( ?, ?, ?, ?, ?, ?, ?, ?, ?,?)}";

            $params = array(
                array($oper, SQLSRV_PARAM_IN), array(&$idE, SQLSRV_PARAM_IN), array(&$Codigo, SQLSRV_PARAM_IN),
                array(&$Marca, SQLSRV_PARAM_IN), array(&$Modelo, SQLSRV_PARAM_IN), array(&$tipo, SQLSRV_PARAM_IN),
                array(&$Sede, SQLSRV_PARAM_IN), array(&$Estado, SQLSRV_PARAM_IN), array(&$Usuario, SQLSRV_PARAM_IN),
                array(&$FechaRe, SQLSRV_PARAM_IN)
            );

            /* ejecuta la consulta. */
            $stmt = sqlsrv_query($conn, $SP, $params);

            if ($stmt === false) {
                echo "Error ejecutando sentencia guardar equipo.\n";
                die(print_r(sqlsrv_errors(), true));
            } else {
                $msj = "ok";
            }
            sqlsrv_free_stmt($stmt);
            sqlsrv_close($conn);
        

        return $msj;
    }

    function modificarEquipo()
    {
        $msj = "";
        $oper = 'A';
        $id= $this->objEquipo->getId();
        $codigo = $this->objEquipo->getCodigo();
        $marca = $this->objEquipo->getMarca();
        $tipo= $this->objEquipo->getTipo();
        $modelo = $this->objEquipo->getModelo();
        $sede = $this->objEquipo->getSede();
        $estado = $this->objEquipo->getEstado();
        $fechaRe = $this->objEquipo->getFechaRegistro();
        $usuario = $this->objEquipo->getUsuario();



        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();




        $SP = "{call Sp_Equipo( ?, ?, ?, ?, ?, ?, ?, ?, ?,?)}";


        $params = array(
            array($oper, SQLSRV_PARAM_IN),
            array(&$id, SQLSRV_PARAM_IN),
            array(&$codigo, SQLSRV_PARAM_IN),
            array(&$marca, SQLSRV_PARAM_IN),
            array(&$modelo, SQLSRV_PARAM_IN),
            array(&$tipo, SQLSRV_PARAM_IN),
            array(&$sede, SQLSRV_PARAM_IN),
            array(&$estado, SQLSRV_PARAM_IN),
            array(&$fechaRe, SQLSRV_PARAM_IN),
            array(&$usuario, SQLSRV_PARAM_IN)
        );

        /* Execute the query. */
        $stmt = sqlsrv_query($conn, $SP, $params);

        if ($stmt === false) {
            echo "Error ejecutando sentencia modificar equipo <br>";
            die(print_r(sqlsrv_errors(), true));
        } else {
            $msj = "ok";
        }

        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);

        return $msj;
    }

    function consultarEquipo()
    {
        $Codigo = intval($this->objEquipo->getCodigo());

        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $SP = "{call sp_consultarEquipo( ?)}";

        $params = array(
            array($Codigo, SQLSRV_PARAM_IN)
        );

        /* Execute the query. */
        $stmt = sqlsrv_query($conn, $SP, $params);
        if ($stmt === false) {
            echo "Error ejecutando sentencia consultar equipo.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        while (sqlsrv_fetch($stmt)) {
            $this->objEquipo->setId(sqlsrv_get_field($stmt, 0));
            $this->objEquipo->setCodigo(sqlsrv_get_field($stmt, 1));
            $this->objEquipo->setMarca(sqlsrv_get_field($stmt, 2));
            $this->objEquipo->setTipo(sqlsrv_get_field($stmt, 3));
            $this->objEquipo->setModelo(sqlsrv_get_field($stmt, 4));
            $this->objEquipo->setSede(sqlsrv_get_field($stmt, 5));
            $this->objEquipo->setEstado(sqlsrv_get_field($stmt, 6));
            $this->objEquipo->setFechaRegistro(sqlsrv_get_field($stmt, 7));
            $this->objEquipo->setUsuario(sqlsrv_get_field($stmt, 8));
        }
        /*Free the statement and connection resources. */
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);

        return $this->objEquipo;
    }

   public function consultarEquipoSede()
    {
        $msj = "";
        $oper = 'S';
        if ($_POST['idSede']) {
            $sede = $_POST['idSede'];
            $sede = 23;
            return json_encode($sede);
        }
        
 
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
    }

    function consultarTodos()
    {

        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $sql = "{CALL sp_equipos()}";

        /* Execute the query. */
        $stmt = sqlsrv_query($conn, $sql);

        if ($stmt === false) {
            echo "Error ejecutando sentencia consultar todos.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        $eq = array();
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {

            $eq[] = $row['id'];
            $eq[] = $row['CodigoAF'];
            $eq[] =  $row['Marca'];
            $eq[] = $row['Modelo'];
            $eq[] = $row['Serial'];
            $eq[] = $row['Estado'];
            $eq[] = $row['FechaRe'];
            $eq[] =  $row['FechaIn'];
            $eq[] =  $row['IdUsuario'];
        }
        var_dump($eq);
        die();
    }

    static function existencia($codigo)
    {

        $objConexion = new ControlConexion();
        $conn = $objConexion->conectar();

        $SP = "{call sp_consultarEquipo( ?)}";

        $params = array(
            array($codigo, SQLSRV_PARAM_IN)
        );

        /* Execute the query. */
        $stmt = sqlsrv_query($conn, $SP, $params);
        if ($stmt === false) {
            echo "Error ejecutando sentencia existencia equipo.\n";
            die(print_r(sqlsrv_errors(), true));
        }

        while (sqlsrv_fetch($stmt)) {
            if (sqlsrv_get_field($stmt, 0) == "") {
                return false;
            } else {
                return true;
            }
        }
        /*Free the statement and connection resources. */
        sqlsrv_free_stmt($stmt);
        sqlsrv_close($conn);
    }
   
}
