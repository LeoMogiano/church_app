<?php

declare(strict_types=1);

class VRelacion
{
    private function renderizarTabla($relaciones, $usuarios, $tiposRelaciones): string
    {
        $rowData = '';

        if (empty($relaciones)) {
            return "<tbody></tbody>";
        }

        foreach ((array)$relaciones as $relacion) {
            $rowData .= "<tr>";
            $rowData .= "<td>{$relacion->getId()}</td>";

            // Buscar Usuario A por ID
            $usuarioA = null;
            foreach ($usuarios as $usuario) {
                if ($usuario->getId() === $relacion->getUsuarioA()) {
                    $usuarioA = $usuario;
                    break;
                }
            }

            $rowData .= "<td>";
            $rowData .= ($usuarioA ? $usuarioA->getNombre() . " " . $usuarioA->getApellido()  : "Usuario no encontrado");
            $rowData .= "</td>";

            // Buscar Usuario B por ID
            $usuarioB = null;
            foreach ($usuarios as $usuario) {
                if ($usuario->getId() === $relacion->getUsuarioB()) {
                    $usuarioB = $usuario;
                    break;
                }
            }

            $rowData .= "<td>";
            $rowData .= ($usuarioB ? $usuarioB->getNombre() . " " . $usuarioB->getApellido()  : "Usuario no encontrado");
            $rowData .= "</td>";

            // Buscar Tipo de Relación A por ID
            $tipoRelacionA = null;
            foreach ($tiposRelaciones as $tipoRelacion) {
                if ($tipoRelacion->getId() === $relacion->getTipoRelacionA()) {
                    $tipoRelacionA = $tipoRelacion;
                    break;
                }
            }

            $rowData .= "<td>";
            $rowData .= ($tipoRelacionA ? $tipoRelacionA->getNombre() : "Tipo de relación no encontrado");
            $rowData .= "</td>";

            // Buscar Tipo de Relación B por ID
            $tipoRelacionB = null;
            foreach ($tiposRelaciones as $tipoRelacion) {
                if ($tipoRelacion->getId() === $relacion->getTipoRelacionB()) {
                    $tipoRelacionB = $tipoRelacion;
                    break;
                }
            }

            $rowData .= "<td>";
            $rowData .= ($tipoRelacionB ? $tipoRelacionB->getNombre() : "Tipo de relación no encontrado");
            $rowData .= "</td>";

            $rowData .= "<td><a href='/editar_relacion?id={$relacion->getId()}' class='edit-button'>Editar</a></td>";
            $rowData .= "<td>";
            $rowData .= "<form id='form_boton_eliminar' method='post' action='/eliminar_relacion'>";
            $rowData .= "<input type='hidden' name='id' value='{$relacion->getId()}'>";
            $rowData .= "<button type='button' onclick='confirmarEliminar({$relacion->getId()})' class='delete-button' style='font-size: 16px;'>Eliminar</button>";
            $rowData .= "</form>";
            $rowData .= "</td>";

            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }


    private function renderizarFormularioCreacion($usuarios, $tiposRelaciones): string
    {
        $formulario = '';

        $formulario .= "<div class='container'>";
        $formulario .= "<h2>Nueva Relación</h2>";
        $formulario .= "<form method='post' action='/relaciones'>";

        $formulario .= "<div class='row'>";
        $formulario .= "<div class='col-12 col-md-6'>";
        $formulario .= "<label for='usuarioA'>Usuario A:</label>";
        $formulario .= "<select name='usuarioA' id='usuarioA' required>";
        foreach ($usuarios as $usuario) {
            $formulario .= "<option value='{$usuario->getId()}'>{$usuario->getNombre()} {$usuario->getApellido()}</option>";
        }
        $formulario .= "</select>";
        $formulario .= "</div>";

        $formulario .= "<div class='col-12 col-md-6'>";
        $formulario .= "<label for='usuarioB'>Usuario B:</label>";
        $formulario .= "<select name='usuarioB' id='usuarioB' required>";
        foreach ($usuarios as $usuario) {
            $formulario .= "<option value='{$usuario->getId()}'>{$usuario->getNombre()} {$usuario->getApellido()}</option>";
        }
        $formulario .= "</select>";
        $formulario .= "</div>";

        $formulario .= "<div class='col-12 col-md-6'>";
        $formulario .= "<label for='tipoRelacionA'>Tipo de Relación A:</label>";
        $formulario .= "<select name='tipoRelacionA' id='tipoRelacionA' required>";
        foreach ($tiposRelaciones as $tipoRelacion) {
            $formulario .= "<option value='{$tipoRelacion->getId()}'>{$tipoRelacion->getNombre()}</option>";
        }
        $formulario .= "</select>";
        $formulario .= "</div>";

        $formulario .= "<div class='col-12 col-md-6'>";
        $formulario .= "<label for='tipoRelacionB'>Tipo de Relación B  :</label>";
        $formulario .= "<select name='tipoRelacionB' id='tipoRelacionB' required>";
        foreach ($tiposRelaciones as $tipoRelacion) {
            $formulario .= "<option value='{$tipoRelacion->getId()}'>{$tipoRelacion->getNombre()}</option>";
        }
        $formulario .= "</select>";
        $formulario .= "</div>";
        $formulario .= "</div>";

        $formulario .= "<div class='row mt-3'>";
        $formulario .= "<div class='col-12 d-flex justify-content-end'>";
        $formulario .= "<button class='add-button' type='submit'>Agregar</button>";
        $formulario .= "<a href='/relacion' class='back-button'>Volver</a>";
        $formulario .= "</div>";
        $formulario .= "</div>";

        $formulario .= "</form>";
        $formulario .= "</div>";

        return $formulario;
    }


    public function actualizar($relaciones, $usuarios, $tiposRelaciones): void
    {
        $title = 'Relación - Usuarios';
        $tbody = $this->renderizarTabla($relaciones, $usuarios, $tiposRelaciones);
        $formulario = $this->renderizarFormularioCreacion($usuarios, $tiposRelaciones);
        include '../app/views/relacion/index.php';
    }

    private function renderizarFormularioEdicion($relacion, $usuarios, $tiposRelaciones): string
    {
        $formulario = '';

        if (!empty($relacion) && $relacion instanceof Relacion) {
            $formulario .= "<form method='post' action='/actualizar_relacion'>";
            $formulario .= "<input type='hidden' name='id' value='{$relacion->getId()}'>";
            $formulario .= "<div class='container-fluid'>";
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-6'>"; // Columna 1 para usuarios

            // Para el campo 'Usuario A'
            $formulario .= "<label for='usuarioA'>Usuario A:</label>";
            $formulario .= "<select id='usuarioA' name='usuarioA' required>";
            foreach ($usuarios as $usuario) {
                $selected = ($usuario->getId() == $relacion->getUsuarioA()) ? 'selected' : '';
                $formulario .= "<option value='{$usuario->getId()}' $selected>{$usuario->getNombre()}</option>";
            }
            $formulario .= "</select>";

            // Continuar con más campos de usuario...

            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-6'>"; // Columna 2 para usuarios

            // Para el campo 'Usuario B'
            $formulario .= "<label for='usuarioB'>Usuario B:</label>";
            $formulario .= "<select id='usuarioB' name='usuarioB' required>";
            foreach ($usuarios as $usuario) {
                $selected = ($usuario->getId() == $relacion->getUsuarioB()) ? 'selected' : '';
                $formulario .= "<option value='{$usuario->getId()}' $selected>{$usuario->getNombre()}</option>";
            }
            $formulario .= "</select>";

            $formulario .= "</div>";
            $formulario .= "</div>";

            // Ahora, dividir los campos de relaciones en dos columnas de 6
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-6'>"; // Columna 1 para tipos de relaciones

            // Para el campo 'Tipo de Relación A'
            $formulario .= "<label for='tipoRelacionA'>Tipo de Relación A:</label>";
            $formulario .= "<select id='tipoRelacionA' name='tipoRelacionA' required>";
            foreach ($tiposRelaciones as $tipoRelacion) {
                $selected = ($tipoRelacion->getId() == $relacion->getTipoRelacionA()) ? 'selected' : '';

                $formulario .= "<option value='{$tipoRelacion->getId()}' $selected>{$tipoRelacion->getNombre()}</option>";
            }
            $formulario .= "</select>";

            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-6'>"; // Columna 2 para tipos de relaciones

            // Para el campo 'Tipo de Relación B'
            $formulario .= "<label for 'tipoRelacionB'>Tipo de Relación B:</label>";
            $formulario .= "<select id='tipoRelacionB' name='tipoRelacionB' required>";
            foreach ($tiposRelaciones as $tipoRelacion) {

                $selected = ($tipoRelacion->getId() == $relacion->getTipoRelacionB()) ? 'selected' : '';
                $formulario .= "<option value='{$tipoRelacion->getId()}' $selected>{$tipoRelacion->getNombre()}</option>";
            }
            $formulario .= "</select>";

            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<div class='row mt-3'>";
            $formulario .= "<div class='col-12 d-flex justify-content-end'>";
            $formulario .= "<button class='add-button' type='submit'>Actualizar</button>";
            $formulario .= "<a href='/relaciones' class='back-button'>Volver</a>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "</form>";
        } else {
            $formulario .= "La relación no se encontró o no existe.";
        }

        return $formulario;
    }



    public function mostrarFormularioEdicion($relacion, $usuarios, $tiposRelaciones): void
    {
        $title = 'Relación - Editar';
        $formulario = $this->renderizarFormularioEdicion($relacion, $usuarios, $tiposRelaciones);
        include '../app/views/relacion/edit.php';
    }
}
