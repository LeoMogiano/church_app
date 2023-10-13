<?php

declare(strict_types=1);

require_once('../app/models/Cargo/MCargo.php');
require_once('../app/views/cargo/VCargo.php');

class CCargo
{
    private VCargo $vista;
    private MCargo $modelo;


    public function __construct()
    {
        $this->vista = new VCargo();
        $this->modelo = new MCargo();
    }

    public function mostrarCargosC(): void
    {

        $tipo_relaciones = $this->modelo->mostrarCargos();

        $this->vista->actualizar($tipo_relaciones);
    }

    public function agregarCargoC(string $nombre, string $descripcion): void
    {

        $this->modelo->agregarCargo($nombre, $descripcion);

        $tipo_relaciones = $this->modelo->mostrarCargos();

        $this->vista->actualizar($tipo_relaciones);
    }

    public function eliminarCargoC(int $id): void
    {
        $this->modelo->eliminarCargo($id);

        $tipo_relaciones = $this->modelo->mostrarCargos();

        $this->vista->actualizar($tipo_relaciones);
    }

    public function updateCargoC(int $id): void
    {
        $tipo_relacion = $this->modelo->buscarCargo($id);

        $this->vista->mostrarFormularioEdicion($tipo_relacion);
    }

    public function editarCargoC(int $id, string $nombre, string $descripcion): void
    {

        $this->modelo->editarCargo($id, $nombre, $descripcion);

        $tipo_relaciones = $this->modelo->mostrarCargos();

        $this->vista->actualizar($tipo_relaciones);
    }
}
