<?php

declare(strict_types=1);

require_once('../app/models/Relacion/MRelacion.php');
require_once('../app/models/Usuario/MUsuario.php');
require_once('../app/models/Tipo_Relacion/MTipoRelacion.php');
require_once('../app/views/relacion/VRelacion.php');

class CRelacion
{
    private VRelacion $vistaRelacion;
    private MTIpoRelacion $modeloTipoRelacion;
    private MUsuario $modeloUsuario;
    private MRelacion $modeloRelacion;

    public function __construct()
    {
        $this->vistaRelacion = new VRelacion();
        $this->modeloTipoRelacion = new MTipoRelacion();
        $this->modeloUsuario = new MUsuario();
        $this->modeloRelacion = new MRelacion();
    }

    public function mostrarRelacionesC(): void
    {
        $relaciones = $this->modeloRelacion->mostrarRelaciones();
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $tiposRelaciones = $this->modeloTipoRelacion->mostrarTipos();
        $this->vistaRelacion->actualizar($relaciones, $usuarios, $tiposRelaciones);
    }

    public function agregarRelacionC(int $usuarioA, int $usuarioB, int $tipoRelacionA, int $tipoRelacionB): void
    {
        $this->modeloRelacion->agregarRelacion($usuarioA, $usuarioB, $tipoRelacionA, $tipoRelacionB);

        $relaciones = $this->modeloRelacion->mostrarRelaciones();
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $tiposRelaciones = $this->modeloTipoRelacion->mostrarTipos();
        $this->vistaRelacion->actualizar($relaciones, $usuarios, $tiposRelaciones);
    }

    public function eliminarRelacionC(int $id): void
    {
        $this->modeloRelacion->eliminarRelacion($id);

        $relaciones = $this->modeloRelacion->mostrarRelaciones();
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $tiposRelaciones = $this->modeloTipoRelacion->mostrarTipos();
        $this->vistaRelacion->actualizar($relaciones, $usuarios, $tiposRelaciones);
    }

    public function editarRelacionC(int $id, int $usuarioA, int $usuarioB, int $tipoRelacionA, int $tipoRelacionB): void
    {
        $this->modeloRelacion->editarRelacion($id, $usuarioA, $usuarioB, $tipoRelacionA, $tipoRelacionB);

        $relaciones = $this->modeloRelacion->mostrarRelaciones();
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $tiposRelaciones = $this->modeloTipoRelacion->mostrarTipos();
        $this->vistaRelacion->actualizar($relaciones, $usuarios, $tiposRelaciones);
    }

    public function updateRelacionC(int $id): void
    {
        $relacion = $this->modeloRelacion->buscarRelacion($id);
        $usuarios = $this->modeloUsuario->mostrarUsuarios();
        $tiposRelaciones = $this->modeloTipoRelacion->mostrarTipos();
        $this->vistaRelacion->mostrarFormularioEdicion($relacion, $usuarios, $tiposRelaciones);
    }
}
