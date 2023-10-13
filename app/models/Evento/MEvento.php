<?php

require_once('../app/models/IglesiaDB.php');
require_once('../app/models/Usuario/Usuario.php');
require_once('../app/models/Evento/Evento.php');

class MEvento extends IglesiaDB
{

    public function __construct()
    {
    }

    public function agregarEvento($nombre, $fecha, $descripcion, $usuario_id): void
{
    $bd = $this->getConnection();
    try {
        $query = "INSERT INTO " . self::TABLE_EVENTO . " (nombre, fecha, descripcion, usuario_id) VALUES (?, ?, ?, ?)";
        $stmt = $bd->prepare($query);
        $stmt->bind_param("sssi", $nombre, $fecha, $descripcion, $usuario_id);
        if ($stmt->execute()) {
            error_log("Evento insertado con éxito");
        }
    } catch (Exception $e) {
        error_log("Excepción al insertar el evento en la base de datos: " . $e->getMessage());
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $bd->close();
    }
}

public function mostrarEventos(): array
{
    $bd = $this->getConnection();

    $eventos = [];

    try {
        $result = $bd->query('SELECT * FROM ' . self::TABLE_EVENTO);

        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $evento = new Evento($row['id'], $row['nombre'], $row['fecha'], $row['descripcion'], $row['usuario_id']);
                $eventos[] = $evento;
            }
        }
    } catch (Exception $e) {
        error_log("Excepción en mostrarEventos: " . $e->getMessage());
    } finally {
        $bd->close();
    }

    return $eventos;
}

public function buscarEvento($id)
{
    $bd = $this->getConnection();

    try {
        $query = "SELECT * FROM " . self::TABLE_EVENTO . " WHERE id = ?";
        $stmt = $bd->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $evento = new Evento($row['id'], $row['nombre'], $row['fecha'], $row['descripcion'], $row['usuario_id']);
            return $evento;
        }
    } catch (Exception $e) {
        error_log("Excepción en buscarEvento: " . $e->getMessage());
    } finally {
        $bd->close();
    }

    return null;
}

public function editarEvento($id, $nombre, $fecha, $descripcion, $usuario_id): void
{
    $bd = $this->getConnection();

    try {
        $query = "UPDATE " . self::TABLE_EVENTO . " SET nombre = ?, fecha = ?, descripcion = ?, usuario_id = ? WHERE id = ?";
        $stmt = $bd->prepare($query);
        $stmt->bind_param("sssii", $nombre, $fecha, $descripcion, $usuario_id, $id);

        if ($stmt->execute()) {
            error_log("Evento editado con éxito");
        }
    } catch (Exception $e) {
        error_log("Excepción al editar el evento: " . $e->getMessage());
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $bd->close();
    }
}

public function eliminarEvento($id): void
{
    $bd = $this->getConnection();

    try {
        $query = "DELETE FROM " . self::TABLE_EVENTO . " WHERE id = ?";
        $stmt = $bd->prepare($query);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            error_log("Evento eliminado con éxito");
        }
    } catch (Exception $e) {
        error_log("Excepción al eliminar el evento: " . $e->getMessage());
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $bd->close();
    }
}

}
