<?php

declare(strict_types=1);

class VUsuario
{
    private function renderizarTabla($usuarios,array $cargos): string
    {
        $rowData = '';
        
        if (empty($usuarios)) {
            return "<tbody></tbody>";
        }

        foreach ((array)$usuarios as $usuario) {
            $rowData .= "<tr>";
            $rowData .= "<td>{$usuario->getId()}</td>";
            $rowData .= "<td>{$usuario->getNombre()}</td>";
            $rowData .= "<td>{$usuario->getApellido()}</td>";
            $rowData .= "<td>{$usuario->getEmail()}</td>";
            $rowData .= "<td>{$usuario->getCI()}</td>";

            // Busca el nombre del cargo basado en el ID del cargo
            $nombreCargo = "";
            foreach ($cargos as $cargo) {
                if ($cargo->getId() == $usuario->getCargoId()) {
                    $rowData .= "<td>{$cargo->getNombre()}</td>";
                    break;
                }
            }
            
            

            $rowData .= "<td><a href='/editar_usuario?id={$usuario->getId()}' class='edit-button'>Editar</a></td>";
            $rowData .= "<td>";
            $rowData .= "<form id='form_boton_eliminar' method='post' action='/eliminar_usuario'>";
            $rowData .= "<input type='hidden' name='id' value='{$usuario->getId()}'>";
            $rowData .= "<button type='button' onclick='confirmarEliminar({$usuario->getId()})' class='delete-button' style='font-size: 16px;'>Eliminar</button>";
            $rowData .= "</form>";
            $rowData .= "</td>";
            $rowData .= "</tr>";
        }

        return "<tbody>$rowData</tbody>";
    }

    public function renderizarFormularioCrear($cargos): string
    {

        $nuevoUsuarioForm = '
    <div class="container">
        <h2>Nuevo Usuario</h2>
        <div id="form_usuario">
            <form action="/usuarios" method="post">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <label for="nombre">Nombre</label>
                        <input name="nombre" type="text" id="nombre" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="apellido">Apellido</label>
                        <input name="apellido" type="text" id="apellido" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="email">Email</label>
                        <input name="email" type="text" id="email" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="ci">CI</label>
                        <input name="ci" type="text" id="ci" required>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="cargo">Cargo</label>
                        <select name="cargo" id="cargo"  required>';

        foreach ($cargos as $cargo) {
            $nuevoUsuarioForm .= "<option value='{$cargo->getId()}'>{$cargo->getNombre()}</option>";
        }

        $nuevoUsuarioForm .= '
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



        return $nuevoUsuarioForm;
    }

    public function actualizar($usuarios, $cargos): void
    {
        $title = 'Usuarios';
        $tbody = $this->renderizarTabla($usuarios, $cargos);
        $formulario = $this->renderizarFormularioCrear($cargos);
        include '../app/views/usuario/index.php';
    }


    private function renderizarFormularioEdicion($usuario, $cargos): string
    {
        $formulario = '';

        if (!empty($usuario)) {
            $formulario .= "<form method='post' action='/actualizar_usuario'>";
            $formulario .= "<input type='hidden' name='id' value='{$usuario->getId()}'>";
            $formulario .= "<div class='container-fluid'>";
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='nombre'>Nombres:</label>";
            $formulario .= "<input type='text' id='nombre' name='nombre' value='{$usuario->getNombre()}' required>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='apellido'>Apellidos:</label>";
            $formulario .= "<input type='text' id='apellido' name='apellido' value='{$usuario->getApellido()}' required>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<div class='row'>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='email'>Email:</label>";
            $formulario .= "<input type='text' id='email' name='email' value='{$usuario->getEmail()}' required>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='ci'>CI:</label>";
            $formulario .= "<input type='text' id='ci' name='ci' value='{$usuario->getCI()}' required>";
            $formulario .= "</div>";
            $formulario .= "<div class='col-12 col-md-4'>";
            $formulario .= "<label for='cargo'>Cargo:</label>";
            $formulario .= "<select name='cargo' id='cargo' required>";

            foreach ($cargos as $cargo) {
                $selected = $cargo->getId() === $usuario->getCargoId() ? 'selected' : '';
                $formulario .= "<option value='{$cargo->getId()}' {$selected}>{$cargo->getNombre()}</option>";
            }

            $formulario .= "</select>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "<br>";
            $formulario .= "<div class='row mt-3'>";
            $formulario .= "<div class='col-12 d-flex justify-content-end'>";
            $formulario .= "<button class='add-button' type='submit'>Actualizar</button>";
            $formulario .= "<a href='/usuarios' class='back-button'>Volver</a>";
            $formulario .= "</div>";
            $formulario .= "</div>";
            $formulario .= "</form>";
        } else {
            $formulario .= "El usuario no se encontró o no existe.";
        }

        return $formulario;
    }

    public function mostrarFormularioEdicion($usuario, $cargos): void
    {
        $title = 'Usuario - Editar';
        $formulario = $this->renderizarFormularioEdicion($usuario, $cargos);
        include '../app/views/usuario/edit.php';
    }
}
