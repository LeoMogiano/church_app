<?php

class Usuario
{
    private $id;
    private $nombre;
    private $apellido;
    private $email;
    private $ci;
    private $cargo_id;

    public function __construct($id, $nombre, $apellido, $email, $ci, $cargo_id)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->email = $email;
        $this->ci = $ci;
        $this->cargo_id = $cargo_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getCI()
    {
        return $this->ci;
    }

    public function setCI($ci)
    {
        $this->ci = $ci;
    }

    public function getCargoId()
    {
        return $this->cargo_id;
    }

    public function setCargoId($cargo_id)
    {
        $this->cargo_id = $cargo_id;
    }

    public function __toString()
    {
        return "Usuario{" .
            "id=" . $this->id .
            ", nombre='" . $this->nombre . '\'' .
            ", apellido='" . $this->apellido . '\'' .
            ", email='" . $this->email . '\'' .
            ", ci='" . $this->ci . '\'' .
            ", cargo_id=" . $this->cargo_id .
            '}';
    }
}
