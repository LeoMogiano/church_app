<?php

declare(strict_types=1);

class VEvento
{
    private function renderizarTabla($eventos, $usuarios): string
    {
        $rowData = '';

        if (empty($eventos)) {
            return "<tbody></tbody>";
        }

        foreach ((array)$eventos as $evento) {
            $rowData .= "<tr>";
            $rowData .= "<td>{$evento->getId()}</td>";
            $rowData .= "<td>{$evento->getNombre()}</td>";
            $rowData .= "<td>{$evento->getFecha()}</td>";
            $rowData .= "<td>{$evento->getDescripcion()}</td>";

            $nombreUsuario = "";
            foreach ($usuarios as $usuario) {
                if ($usuario->getId() === $evento->getUsuarioId()) {
                    $nombreUsuario = "{$usuario->getNombre()} {$usuario->getApellido()}";
                    break;
                }
            }

            $rowData .= "<td>{$nombreUsuario}</td>";

            $rowData .= "<td><a href='/editar_evento?id={$evento->getId()}' class='edit-button'>Editar</a></td>";
            $rowData .= "<td>";
            $rowData .= "<form id='form_boton_eliminar' method='post' action='/eliminar_evento'>";
            $rowData .= "<input type='hidden' name='id' value='{$evento->getId()}'>";
            $rowData .= "<button type='button' onclick='confirmarEliminar({$evento->getId()})' class='delete-button' style='font-size: 16px;'>Eliminar</button>";
            $rowData .= "</form>";
            $rowData .= "</td>";
            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }

    public function renderizarFormularioCrear($usuarios): string
    {
        $nuevoEventoForm = '
        <div class="container">
            <h2>Nuevo Evento</h2>
            <div id="form_evento">
                <form action="/eventos" method="post">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="nombre">Nombre</label>
                            <input name="nombre" type="text" id="nombre" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="fecha">Fecha</label>
                            <input name="fecha" type="date" id="fecha" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="descripcion">Descripción</label>
                            <input name="descripcion" type="text" id="descripcion" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="usuario_id">Usuario</label>
                            <select name="usuario_id" id="usuario_id" required>';

        foreach ($usuarios as $usuario) {
            $nuevoEventoForm .= "<option value='{$usuario->getId()}'>{$usuario->getNombre()} {$usuario->getApellido()}</option>";
        }

        $nuevoEventoForm .= '
                            </select>
                        </div>
                    </div>
                    <br>
                    <div class="row mt-3">
                        <div class="col-12 d-flex justify-content-end">
                            <button class="add-button" type="submit">Agregar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        ';

        return $nuevoEventoForm;
    }


    public function actualizar($eventos, $usuarios): void
    {
        $title = 'Eventos';
        $tbody = $this->renderizarTabla($eventos, $usuarios);
        $formulario = $this->renderizarFormularioCrear($usuarios);
        include '../app/views/evento/index.php';
    }

    private function renderizarFormularioEdicion($evento, $usuarios): string
    {
        $formulario = '';

        if (!empty($evento)) {
            $formulario .= "<form method='post' action='/actualizar_evento'>";
            $formulario .= "<input type='hidden' name='id' value='{$evento->getId()}'>";
            $formulario .= "<div class='container-fluid'>";
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='nombre'>Nombre:</label>";
            $formulario .= "<input type='text' id='nombre' name='nombre' value='{$evento->getNombre()}' required>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='fecha'>Fecha:</label>";
            $formulario .= "<input type='date' id='fecha' name='fecha' value='{$evento->getFecha()}' required>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='descripcion'>Descripción:</label>";
            $formulario .= "<input type='text' id='descripcion' name='descripcion' value='{$evento->getDescripcion()}' required>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='usuario_id'>Usuario:</label>";
            $formulario .= "<select name='usuario_id' id='usuario_id' required>";

            foreach ($usuarios as $usuario) {
                $selected = $usuario->getId() == $evento->getUsuarioId() ? 'selected' : '';
                $formulario .= "<option value='{$usuario->getId()}' {$selected}>{$usuario->getNombre()} {$usuario->getApellido()}</option>";
            }

            $formulario .= "</select>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<br>";
            $formulario .= "<div class='row mt-3'>";
            $formulario .= "<div class='col-12 d-flex justify-content-end'>";
            $formulario .= "<button class='add-button' type='submit'>Actualizar</button>";
            $formulario .= "<a href='/eventos' class='back-button'>Volver</a>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "</form>";
        } else {
            $formulario .= "El evento no se encontró o no existe.";
        }

        return $formulario;
    }


    public function mostrarFormularioEdicion($evento, $usuarios): void
    {
        $title = 'Evento - Editar';
        $formulario = $this->renderizarFormularioEdicion($evento, $usuarios);
        include '../app/views/evento/edit.php';
    }
}
