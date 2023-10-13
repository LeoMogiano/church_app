<?php

declare(strict_types=1);

require_once('../app/models/Usuario/MUsuario.php');
require_once('../app/models/Cargo/MCargo.php');
require_once('../app/views/usuario/VUsuario.php');

class CUsuario
{
    private VUsuario $vista;
    private MUsuario $modeloUsuario;
    private MCargo $modeloCargo;

    public function __construct()
    {
        $this->vista = new VUsuario();
        $this->modeloUsuario = new MUsuario();
        $this->modeloCargo = new MCargo(); 
    }
    

    public function mostrarUsuariosC(): void
    {
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $cargos = $this->modeloCargo->mostrarCargos();
        /* var_dump($cargos); */
        $this->vista->actualizar($usuarios, $cargos);
    }

    public function agregarUsuarioC(string $nombre, string $apellido, string $email, string $ci, int $cargo_id): void
    {
        $this->modeloUsuario->agregarUsuario($nombre, $apellido, $email, $ci, $cargo_id);
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $cargos = $this->modeloCargo->mostrarCargos();
        $this->vista->actualizar($usuarios, $cargos);
    }

    public function eliminarUsuarioC(int $id): void
    {
        $this->modeloUsuario->eliminarUsuario($id);
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $cargos = $this->modeloCargo->mostrarCargos();
        $this->vista->actualizar($usuarios, $cargos);
    }

    public function editarUsuarioC(int $id, string $nombre, string $apellido, string $email, string $ci, int $cargo_id): void
    {
        $this->modeloUsuario->editarUsuario($id, $nombre, $apellido, $email, $ci, $cargo_id);
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $cargos = $this->modeloCargo->mostrarCargos();
        $this->vista->actualizar($usuarios, $cargos);
    }

    public function updateUsuarioC(int $id): void
    {
        $usuario = $this->modeloUsuario->buscarUsuario($id);
        $cargos = $this->modeloCargo->mostrarCargos();
        $this->vista->mostrarFormularioEdicion($usuario, $cargos);
    }
}
