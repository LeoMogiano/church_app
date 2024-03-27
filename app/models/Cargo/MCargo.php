<?php

require_once('../app/models/IglesiaDB.php');
require_once('../app/models/Cargo/Cargo.php');

class MCargo 
{
    private IglesiaDB $database;

    public function __construct()
    {
        $this->database = new IglesiaDB();
    }

    public function agregarCargo(string $nombre, string $descripcion): void
    {
        $bd = $this->database->getConnection();
        try {
            $query = "INSERT INTO " . $this->database::TABLE_CARGO . " (nombre, descripcion) VALUES (?, ?)";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("ss", $nombre, $descripcion);
            if ($stmt->execute()) {
                error_log("Cargo insertado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al insertar el cargo en la base de datos: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    public function mostrarCargos(): array
    {
        $bd = $this->database->getConnection();

        $cargos = [];

        try {
            $result = $bd->query('SELECT * FROM ' . $this->database::TABLE_CARGO);

            if ($result) {
                while ($row = $result->fetch_assoc()) {

                    $cargo = new Cargo($row['id'], $row['nombre'], $row['descripcion']);
                    $cargos[] = $cargo;
                }
            }
        } catch (Exception $e) {
            error_log("Excepción en mostrarCargos: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return $cargos;
    }

    public function buscarCargo(int $id): Cargo
    {
        $bd = $this->database->getConnection();

        try {
            $query = "SELECT * FROM " . $this->database::TABLE_CARGO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                // Crear y devolver un objeto Cargo a partir de los datos de la fila
                $cargo = new Cargo($row['id'], $row['nombre'], $row['descripcion']);
                return $cargo;
            }
        } catch (Exception $e) {
            error_log("Excepción en buscarCargo: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return null;
    }

    public function editarCargo(int $id, string $nombre, string $descripcion): void
    {
        $bd = $this->database->getConnection();

        try {
            $query = "UPDATE " . $this->database::TABLE_CARGO . " SET nombre = ?, descripcion = ? WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("ssi", $nombre, $descripcion, $id);

            if ($stmt->execute()) {
                error_log("Cargo editado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al editar el cargo: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }


    public function eliminarCargo(int $id): void
    {
        $bd = $this->database->getConnection();

        try {
            $query = "DELETE FROM " . $this->database::TABLE_CARGO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                error_log("Cargo eliminado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al eliminar el cargo: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }
}
