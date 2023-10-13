<?php

class Evento {
    private $id;
    private $nombre;
    private $fecha;
    private $descripcion;
    private $usuario_id;

    public function __construct($id, $nombre, $fecha, $descripcion, $usuario_id) {

        $this->id = $id;     
        $this->nombre = $nombre;
        $this->fecha = $fecha;
        $this->descripcion = $descripcion;
        $this->usuario_id = $usuario_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function getFecha() {
        return $this->fecha;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function getUsuarioId() {
        return $this->usuario_id;
    }

    public function setUsuarioId($usuario_id) {
        $this->usuario_id = $usuario_id;
    }
}
