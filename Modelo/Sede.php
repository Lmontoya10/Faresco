<?php

class Sede
{
    var $id;
    var $descripcion;
    var $fechaCrea;
    var $usuarioCrea;

    function __construct($id, $descripcion,$fechaCrea,$usuarioCrea)
    {
        $this->id = $id;
        $this->descripcion = $descripcion;
        $this->fechaCrea=$fechaCrea;
        $this->usuarioCrea=$usuarioCrea;

    }

    function getId()
    {
        return $this->id;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }
    function getFechaCrea()
    {
        return $this->fechaCrea;
    }
    function getUsuario()
    {
        return $this->usuarioCrea;
    }

    function setId($id)
    {
        $this->id = $id;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    function setFechaCrea($fechaCrea)
    {
        $this->fechaCrea = $fechaCrea;
    }
}
