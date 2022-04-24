<?php 

class Usuario{

var $idUsario;
var $nombre;
var $correo;
var $rol;
var $clave;
var $apellido;
var $tipoDoc;


function __construct($idUsario,$nombre,$correo, $rol,$clave, $apellido, $tipoDoc)
{
   $this->idUsario= $idUsario; 
   $this->nombre = $nombre;
   $this->correo= $correo;
   $this->rol = $rol;
   $this->clave = $clave;
   $this->apellido = $apellido;
   $this->tipoDoc = $tipoDoc;
}

function getIdUsuario(){
    return $this->idUsario;
}
function getNombre(){
    return $this->nombre;
}
function getCorreo(){
    return $this->correo;
}
function getRol(){
    return $this->rol;
}
function getClave(){
    return $this->clave;
}
function getApellido(){
    return $this->apellido;
}
function gettipoDoc(){
    return $this->tipoDoc;
}


function setIdUsuario($idUsario){
    $this->idUsario = $idUsario;
}
function setNombre($nombre){
    $this->nombre = $nombre;
}
function setCorreo($correo){
    $this->correo = $correo;
}
function setRol($rol){
    $this->rol = $rol;
}
function setClave($clave){
    $this->clave = $clave;
}
function setApellido($apellido){
    $this->apellido = $apellido;
}
function setTipoDoc($tipoDoc){
    $this->tipoDoc = $tipoDoc;
}


}
?>