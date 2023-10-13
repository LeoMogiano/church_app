<?php

declare(strict_types=1);

require_once('../app/models/Evento/MEvento.php');
require_once('../app/models/Usuario/MUsuario.php');
require_once('../app/views/evento/VEvento.php');

class CEvento
{
    private VEvento $vista;
    private MEvento $modeloEvento;
    private MUsuario $modeloUsuario;

    public function __construct()
    {
        $this->vista = new VEvento();
        $this->modeloEvento = new MEvento();
        $this->modeloUsuario = new MUsuario();
    }

    public function mostrarEventosC(): void
    {
        $eventos = $this->modeloEvento->mostrarEventos();
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $this->vista->actualizar($eventos, $usuarios);
    }

    public function agregarEventoC(string $nombre, string $fecha, string $descripcion, int $usuario_id): void
    {
        $this->modeloEvento->agregarEvento($nombre, $fecha, $descripcion, $usuario_id);
        $eventos = $this->modeloEvento->mostrarEventos();
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $this->vista->actualizar($eventos, $usuarios);
    }

    public function eliminarEventoC(int $id): void
    {
        $this->modeloEvento->eliminarEvento($id);
        $eventos = $this->modeloEvento->mostrarEventos();
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $this->vista->actualizar($eventos, $usuarios);
    }

    public function editarEventoC(int $id, string $nombre, string $fecha, string $descripcion, int $usuario_id): void
    {
        $this->modeloEvento->editarEvento($id, $nombre, $fecha, $descripcion, $usuario_id);
        $eventos = $this->modeloEvento->mostrarEventos();
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $this->vista->actualizar($eventos, $usuarios);
    }

    public function updateEventoC(int $id): void
    {
        $evento = $this->modeloEvento->buscarEvento($id);
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $this->vista->mostrarFormularioEdicion($evento, $usuarios);
    }
}
