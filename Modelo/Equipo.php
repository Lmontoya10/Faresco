<?php

class Equipo {
    var $id;
    var $codigo;
    var $marca;
    var $modelo;
    var $fechaRegistro;
    var $serial;
    var $estado;
    var $fechaInactivo;
    var $usuario;
    
    function __construct($id, $codigo, $marca, $modelo, $fechaRegistro, $fechaInactivo, $serial, $estado, $usuario) {
        $this->id = $id;
        $this->codigo = $codigo;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->fechaRegistro = $fechaRegistro;
        $this->fechaInactivo = $fechaInactivo;
        $this->serial = $serial;
        $this->estado = $estado;
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

    function getFechaRegistro() {
        return $this->fechaRegistro;
    }

    function getFechaInactivo() {
        return $this->fechaInactivo;
    }

    function getSerial() {
        return $this->serial;
    }

    function getEstado() {
        return $this->estado;
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

    function setFechaRegistro($fechaRegistro) {
        $this->fechaRegistro = $fechaRegistro;
    }

    function setFechaInactivo($fechaInactivo) {
        $this->fechaInactivo = $fechaInactivo;
    }

    function setSerial($serial) {
        $this->serial = $serial;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }

    function setUsuario($usuario) {
        $this->usuario = $usuario;
    }
}
