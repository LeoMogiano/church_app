<?php

require_once('../app/models/IglesiaDB.php');
require_once('../app/models/Relacion/Relacion.php');


class MRelacion
{
    private IglesiaDB $database;

    public function __construct()
    {
        $this->database = new IglesiaDB();
    }

    // Función para agregar una nueva relación
    public function agregarRelacion($usuarioA, $usuarioB, $tipoRelacionA, $tipoRelacionB): void
    {
        $bd = $this->database->getConnection();
        try {
            $query = "INSERT INTO " . $this->database::TABLE_RELACION . " (usuario_a, usuario_b, tipo_relacion_a, tipo_relacion_b) VALUES (?, ?, ?, ?)";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("iiii", $usuarioA, $usuarioB, $tipoRelacionA, $tipoRelacionB);
            if ($stmt->execute()) {
                error_log("Relación insertada con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al insertar la relación a la base de datos: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    // Función para obtener todas las relaciones
    public function mostrarRelaciones(): array
    {
        $bd = $this->database->getConnection();
        $relaciones = [];

        try {
            $result = $bd->query('SELECT * FROM ' . $this->database::TABLE_RELACION);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $relacion = new Relacion($row['id'], $row['usuario_a'], $row['usuario_b'], $row['tipo_relacion_a'], $row['tipo_relacion_b']);
                    $relaciones[] = $relacion;
                }
            }
        } catch (Exception $e) {
            error_log("Excepción en obtenerRelaciones: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return $relaciones;
    }

    // Función para buscar una relación por su ID
    public function buscarRelacion($id)
    {
        $bd = $this->database->getConnection();
        try {
            $query = "SELECT * FROM " . $this->database::TABLE_RELACION . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $relacion = new Relacion($row['id'] ,$row['usuario_a'], $row['usuario_b'], $row['tipo_relacion_a'], $row['tipo_relacion_b']);
                return $relacion;
            }
        } catch (Exception $e) {
            error_log("Excepción en buscarRelacion: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return null;
    }

    // Función para editar una relación
    public function editarRelacion($id, $usuarioA, $usuarioB, $tipoRelacionA, $tipoRelacionB): void
    {
        $bd = $this->database->getConnection();
        try {
            $query = "UPDATE " . $this->database::TABLE_RELACION . " SET usuario_a = ?, usuario_b = ?, tipo_relacion_a = ?, tipo_relacion_b = ? WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("iiiii", $usuarioA, $usuarioB, $tipoRelacionA, $tipoRelacionB, $id);

            if ($stmt->execute()) {
                error_log("Relación editada con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al editar la relación: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    // Función para eliminar una relación por su ID
    public function eliminarRelacion($id): void
    {
        $bd = $this->database->getConnection();
        try {
            $query = "DELETE FROM " . $this->database::TABLE_RELACION . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                error_log("Relación eliminada con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al eliminar la relación: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }
}
