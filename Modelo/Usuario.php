<?php 

class Usuario{

var $idUusario;
var $correo;
var $clave;
var $rol;
var $estado;
var $nombre;

function __construct($idUusario, $correo, $clave, $tipo, $estado, $nombre)
{
   $this->idUusario= $idUusario; 
   $this->correo= $correo;
   $this->clave = $clave;
   $this->tipo = $tipo;
   $this->estado = $estado;
   $this->nombre = $nombre;
}

function getIdUsuario(){
    return $this->idUusario;
}
function getCorreo(){
    return $this->correo;
}
function getClave(){
    return $this->clave;
}
function getTipo(){
    return $this->tipo;
}
function getEstado(){
    return $this->estado;
}
function getNombre(){
    return $this->nombre;
}

function setIdUsuario($idUusario){
    $this->idUusario = $idUusario;
}
function setCorreo($correo){
    $this->correo = $correo;
}
function setClave($clave){
    $this->clave = $clave;
}
function setTipo($tipo){
    $this->tipo = $tipo;
}
function setEstado($estado){
    $this->estado = $estado;
}
function setNombre($nombre){
    $this->nombre = $nombre;
}

}
?>