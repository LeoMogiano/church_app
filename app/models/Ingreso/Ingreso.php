<?php

class Ingreso
{
    private $id;
    private $tipoIngreso;
    private $monto;
    private $eventoId;

    public function __construct($id, $tipoIngreso, $monto, $eventoId)
    {
        $this->id = $id;
        $this->tipoIngreso = $tipoIngreso;
        $this->monto = $monto;
        $this->eventoId = $eventoId;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTipoIngreso()
    {
        return $this->tipoIngreso;
    }

    public function setTipoIngreso($tipoIngreso)
    {
        $this->tipoIngreso = $tipoIngreso;
    }

    public function getMonto()
    {
        return $this->monto;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;
    }

    public function getEventoId()
    {
        return $this->eventoId;
    }

    public function setEventoId($eventoId)
    {
        $this->eventoId = $eventoId;
    }
}
