<?php

declare(strict_types=1);

class VIngreso
{
    private function renderizarTabla($ingresos, $eventos): string
    {
        $rowData = '';

        if (empty($ingresos)) {
            return "<tbody></tbody>";
        }

        foreach ((array)$ingresos as $ingreso) {
            $rowData .= "<tr>";
            $rowData .= "<td>{$ingreso->getId()}</td>";
            $rowData .= "<td>{$ingreso->getTipoIngreso()}</td>";
            $rowData .= "<td>{$ingreso->getMonto()}</td>";

            $nombreEvento = "";
            foreach ($eventos as $evento) {
                if ($evento->getId() === $ingreso->getEventoId()) {
                    $nombreEvento = $evento->getNombre();
                    break;
                }
            }

            $rowData .= "<td>{$nombreEvento}</td>";
            $rowData .= "<td><a href='/editar_ingreso?id={$ingreso->getId()}' class='edit-button'>Editar</a></td>";
            $rowData .= "<td>";
            $rowData .= "<form id='form_boton_eliminar' method='post' action='/eliminar_ingreso'>";
            $rowData .= "<input type='hidden' name='id' value='{$ingreso->getId()}'>";
            $rowData .= "<button type='button' onclick='confirmarEliminar({$ingreso->getId()})' class='delete-button' style='font-size: 16px;'>Eliminar</button>";
            $rowData .= "</form>";
            $rowData .= "</td>";
            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }

    public function renderizarFormularioCrear($eventos): string
    {
        $nuevoIngresoForm = '
        <div class="container">
            <h2>Nuevo Ingreso</h2>
            <div id="form_ingreso">
                <form action="/ingresos" method="post">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <label for="tipoIngreso">Tipo de Ingreso</label>
                            <input name="tipoIngreso" type="text" id="tipoIngreso" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="monto">Monto</label>
                            <input name="monto" type="text" id="monto" required>
                        </div>
                        <div class="col-12 col-md-4">
                            <label for="evento_id">Evento</label>
                            <select name="evento_id" id="evento_id" required>';

        foreach ($eventos as $evento) {
            $nuevoIngresoForm .= "<option value='{$evento->getId()}'>{$evento->getNombre()}</option>";
        }

        $nuevoIngresoForm .= '
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

        return $nuevoIngresoForm;
    }

    public function actualizar($ingresos, $eventos): void
    {
        $title = 'Ingresos';
        $tbody = $this->renderizarTabla($ingresos, $eventos);
        $formulario = $this->renderizarFormularioCrear($eventos);
        include '../app/views/ingreso/index.php';
    }

    private function renderizarFormularioEdicion($ingreso, $eventos): string
    {
        $formulario = '';

        if (!empty($ingreso)) {
            $formulario .= "<form method='post' action='/actualizar_ingreso'>";
            $formulario .= "<input type='hidden' name='id' value='{$ingreso->getId()}'>";
            $formulario .= "<div class='container-fluid'>";
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='tipoIngreso'>Tipo de Ingreso:</label>";
            $formulario .= "<input type='text' id='tipoIngreso' name='tipoIngreso' value='{$ingreso->getTipoIngreso()}' required>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='monto'>Monto:</label>";
            $formulario .= "<input type='text' id='monto' name='monto' value='{$ingreso->getMonto()}' required>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='evento_id'>Evento:</label>";
            $formulario .= "<select name='evento_id' id='evento_id' required>";

            foreach ($eventos as $evento) {
                $selected = $evento->getId() == $ingreso->getEventoId() ? 'selected' : '';
                $formulario .= "<option value='{$evento->getId()}' {$selected}>{$evento->getNombre()}</option>";
            }

            $formulario .= "</select>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<br>";
            $formulario .= "<div class='row mt-3'>";
            $formulario .= "<div class='col-12 d-flex justify-content-end'>";
            $formulario .= "<button class='add-button' type='submit'>Actualizar</button>";
            $formulario .= "<a href='/ingresos' class='back-button'>Volver</a>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "</form>";
        } else {
            $formulario .= "El ingreso no se encontró o no existe.";
        }

        return $formulario;
    }

    public function mostrarFormularioEdicion($ingreso, $eventos): void
    {
        $title = 'Ingreso - Editar';
        $formulario = $this->renderizarFormularioEdicion($ingreso, $eventos);
        include '../app/views/ingreso/edit.php';
    }
}
