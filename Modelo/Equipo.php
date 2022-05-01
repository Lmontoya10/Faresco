<?php

class Equipo {
    var $id;
    var $codigo;
    var $marca;
    var $modelo;
    var $tipo;
    var $sede;
    var $estado;
    var $fechaRegistro;
    var $usuario;
    
    function __construct($id, $codigo, $marca,$modelo, $tipo,$sede,$estado,$fechaRegistro,$usuario) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->sede = $sede;
        $this->tipo = $tipo;
        $this->estado = $estado;
        $this->fechaRegistro = $fechaRegistro;
        $this->usuario = $usuario;
    }

    function getId() {
        return $this->id;
    }
    
    function getCodigo() {
        return $this->codigo;
    }

    function getMarca() {
        return $this->marca;
    }

    function getModelo() {
        return $this->modelo;
    }
    function getSede() {
        return $this->sede;
    }

    function getTipo() {
        return $this->tipo;
    }

    function getEstado() {
        return $this->estado;
    }

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getUsuario() {
        return $this->usuario;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    function setMarca($marca) {
        $this->marca = $marca;
    }

    function setModelo($modelo) {
        $this->modelo = $modelo;
    }
    
    function setSede($sede) {
        $this->sede = $sede;
    }
    
    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
}
