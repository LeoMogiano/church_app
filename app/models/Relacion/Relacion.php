<?php

class Relacion {
    private $id;
    private $usuarioA;
    private $usuarioB;
    private $tipoRelacionA;
    private $tipoRelacionB;

    public function __construct($id, $usuarioA, $usuarioB, $tipoRelacionA, $tipoRelacionB) {
        $this->id = $id;
        $this->usuarioA = $usuarioA;
        $this->usuarioB = $usuarioB;
        $this->tipoRelacionA = $tipoRelacionA;
        $this->tipoRelacionB = $tipoRelacionB;
    }

    
    public function getId() {
        return $this->id;
    }

    public function getUsuarioA() {
        return $this->usuarioA;
    }

    public function setUsuarioA($usuarioA) {
        $this->usuarioA = $usuarioA;
    }

    public function getUsuarioB() {
        return $this->usuarioB;
    }

    public function setUsuarioB($usuarioB) {
        $this->usuarioB = $usuarioB;
    }

    public function getTipoRelacionA() {
        return $this->tipoRelacionA;
    }

    public function setTipoRelacionA($tipoRelacionA) {
        $this->tipoRelacionA = $tipoRelacionA;
    }

    public function getTipoRelacionB() {
        return $this->tipoRelacionB;
    }

    public function setTipoRelacionB($tipoRelacionB) {
        $this->tipoRelacionB = $tipoRelacionB;
    }

    public function __toString() {
        return "Relación [ID: {$this->id}, Usuario A: {$this->usuarioA}, Usuario B: {$this->usuarioB}, Tipo de Relación A: {$this->tipoRelacionA}, Tipo de Relación B: {$this->tipoRelacionB}]";
    }
}
