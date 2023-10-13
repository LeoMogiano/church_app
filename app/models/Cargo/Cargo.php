<?php

class Cargo
{
    private $id;
    private $nombre;
    private $descripcion;

    public function __construct($id, $nombre, $descripcion)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function __toString()
    {
        return "Cargo{" .
            "id=" . $this->id .
            ", nombre='" . $this->nombre . '\'' .
            ", descripcion='" . $this->descripcion . '\'' .
            '}';
    }
}