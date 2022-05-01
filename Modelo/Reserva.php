<?php
class Reserva{
    var $idReserva;
    var $FechaRes;
    var $HoraIni;
    var $HoraFin;
    var $FechaReg;
    var $Equipo;
    var $Sede;
    var $Usuario;
    var $Estado;

    function __construct($idReserva, $FechaRes, $HoraIni, $HoraFin, $FechaReg, $Equipo,$Sede, $Usuario, $Estado)
    {
        $this->idReserva=$idReserva;
        $this->FechaRes=$FechaRes;
        $this->HoraIni=$HoraIni;
        $this->HoraFin=$HoraFin;
        $this->FechaReg=$FechaReg;
        $this->Equipo=$Equipo;
        $this->Sede=$Sede;
        $this->Usuario=$Usuario;
        $this->Estado=$Estado;
    }
    

    function getIdReserva() {
        return $this->idReserva;
    }
    function getFechaRes() {
        return $this->FechaRes;
    }
    function getHoraIni() {
        return $this->HoraIni;
    }
    function getHoraFin() {
        return $this->HoraFin;
    }
    function getFechaReg() {
        return $this->FechaReg;
    }
    function getEquipo() {
        return $this->Equipo;
    }
    function getSede() {
        return $this->Sede;
    }
    function getUsuario() {
        return $this->Usuario;
    }
    function getEstado() {
        return $this->Estado;
    }


    function setIdReserva($idReserva) {
        $this->idReserva = $idReserva;
    }

    function setFechaRes($FechaRes) {
        $this->FechaRes = $FechaRes;
    }

    function setHoraIni($HoraIni) {
        $this->HoraIni = $HoraIni;
    }

    function setHoraFin($HoraFin) {
        $this->HoraFin = $HoraFin;
    }

    function setFechaReg($FechaReg) {
        $this->FechaReg = $FechaReg;
    }

    function setEquipo($Equipo) {
        $this->Equipo = $Equipo;
    }
    function setSede($Sede) {
        $this->Sede = $Sede;
    }
    function setUsuario($Usuario) {
        $this->Usuario = $Usuario;
    }
    function setEstado($Estado) {
        $this->Estado = $Estado;
    }
    
}

