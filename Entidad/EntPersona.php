<?php
class Persona
{
    private $id;
    private $nombres;
    private $apellidos;
    private $cedula;

    function __construct($id = 0, $nombres ='',$apellidos = '', $cedula ='')
    {
        $this->id = $id;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->cedula = $cedula;
    }

    function __get($name)
    {
        return $this->$name;
    }
    function __set($name, $value)
    {
        return $this->$name = $value;
    }
}