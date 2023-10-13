<?php

declare(strict_types=1);

class VTipoRelacion
{
  private function renderizarTabla($rows): string
  {
    $rowData = '';

    if (empty($rows)) {
      return "<tbody></tbody>";
    }

    foreach ((array)$rows as $row) {
      $rowData .= "<tr>";
      $rowData .= "<td>{$row->getId()}</td>";
      $rowData .= "<td>{$row->getNombre()}</td>";
      $rowData .= "<td><a href='/editar_tipo_relacion?id={$row->getId()}' class='edit-button'>Editar</a></td>";
      $rowData .= "<td>";
      $rowData .= "<form id='form_boton_eliminar' method='post' action='/eliminar_tipo_relacion'>";
      $rowData .= "<input type='hidden' name='id' value='{$row->getId()}'>";
      $rowData .= "<button type='button' onclick='confirmarEliminar({$row->getId()})' class='delete-button' style='font-size: 16px;'>Eliminar</button>";
      $rowData .= "</form>";
      $rowData .= "</td>";
      $rowData .= "</tr>";
    }

    return "<tbody>$rowData</tbody>";
  }

  public function actualizar($tipo_relaciones): void
  {
    $title = 'Tipo Relación - Usuarios';
    $tbody = $this->renderizarTabla($tipo_relaciones);
    include '../app/views/tipo_relacion/index.php';
  }

  private function renderizarFormularioEdicion($tipo_relacion): string
  {
    $formulario = '';

    if (!empty($tipo_relacion) && $tipo_relacion instanceof TipoRelacion) {
      $formulario .= "<form method='post' action='/actualizar_tipo_relacion'>";
      $formulario .= "<input type='hidden' name='id' value='{$tipo_relacion->getId()}'>";
      $formulario .= "<div class='container-fluid'>";
      $formulario .= "<div class='row'>";
      $formulario .= "<div class='col-12 col-md-4'>";
      $formulario .= "<label for='nombre'>Nombres:</label>";
      $formulario .= "<input type='text' id='nombre' name='nombre' value='{$tipo_relacion->getNombre()}' required>";
      $formulario .= "</div>";
      $formulario .= "</div>";
      $formulario .= "<div class='row mt-3'>";
      $formulario .= "<div class='col-12 d-flex justify-content-end'>";
      $formulario .= "<button class='add-button' type='submit'>Actualizar</button>";
      $formulario .= "<a href='/tipo_relacion' class='back-button'>Volver</a>";
      $formulario .= "</div>";
      $formulario .= "</div>";
      $formulario .= "</form>";
  } else {
      $formulario .= "El tipo de relación no se encontró o no existe.";
  }
  
  return $formulario;
  
  }

  public function mostrarFormularioEdicion($tipo_relacion): void
  {
    $title = 'Tipo Relación - Editar';
    $formulario = $this->renderizarFormularioEdicion($tipo_relacion);
    include '../app/views/tipo_relacion/edit.php';
  }
}
