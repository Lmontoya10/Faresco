<?php

class Falla
{
    var $id;
    var $idReserva;
    var $falla;
    var $solucion;
    var $usuarioFalla;
    var $usuarioSol;
    var $fechaFalla;
    var $fechaSol;

    function __construct($id,$idReserva,$falla,$solucion,$usuarioFalla,$usuarioSol,
    $fechaFalla,$fechaSol) {
       $this->id=$id;
       $this->idReserva=$idReserva;
       $this->falla=$falla;
       $this->solucion=$solucion;
       $this->usuarioFalla=$usuarioFalla;
       $this->usuarioSol=$usuarioSol;
    }

    function getId() {
        return $this->id;
    }
    function getIdReserva() {
        return $this->idReserva;
    }
    function getFalla() {
        return $this->falla;
    }
    function getSolucion() {
        return $this->solucion;
    }
    function getUsuarioFalla() {
        return $this->usuarioFalla;
    }
    function getUsuarioSol() {
        return $this->usuarioSol;
    }
    function getFechaFalla() {
        return $this->fechaFalla;
    }
    function getFechaSol() {
        return $this->fechaSol;
    }

    function setId($id) {
        $this->id = $id;
    }
    function setIdReserva($idReserva) {
        $this->idReserva = $idReserva;
    }
    function setSede($solucion) {
        $this->solucion = $solucion;
    }
    function setUsuarioFalla($usuarioFalla) {
        $this->usuarioFalla = $usuarioFalla;
    }
    function setUsuarioSol($usuarioSol) {
        $this->usuarioSol = $usuarioSol;
    }
    function setFechaFalla($fechaFalla) {
        $this->fechaFalla = $fechaFalla;
    }
    function setFechaSol($fechaSol) {
        $this->fechaSol = $fechaSol;
    }
}
