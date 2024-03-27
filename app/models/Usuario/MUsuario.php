<?php

require_once('../app/models/IglesiaDB.php');
require_once('../app/models/Usuario/Usuario.php');

class MUsuario
{
    private IglesiaDB $database;

    public function __construct()
    {
        $this->database = new IglesiaDB();
    }

    public function agregarUsuario($nombre, $apellido, $email, $ci, $cargo_id): void
    {
        $bd = $this->database->getConnection();
        try {
            $query = "INSERT INTO " . $this->database::TABLE_USUARIO . " (nombre, apellido, email, ci, cargo_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("ssssi", $nombre, $apellido, $email, $ci, $cargo_id);
            if ($stmt->execute()) {
                error_log("Usuario insertado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al insertar el usuario en la base de datos: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    public function mostrarUsuarios(): array
    {
        $bd = $this->database->getConnection();

        $usuarios = [];

        try {
            $result = $bd->query('SELECT * FROM ' . $this->database::TABLE_USUARIO);

            if ($result) {
                while ($row = $result->fetch_assoc()) {
                    $usuario = new Usuario($row['id'], $row['nombre'], $row['apellido'], $row['email'], $row['ci'], $row['cargo_id']);
                    $usuarios[] = $usuario;
                }
            }
        } catch (Exception $e) {
            error_log("Excepción en mostrarUsuarios: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return $usuarios;
    }

    public function buscarUsuario($id)
    {
        $bd = $this->database->getConnection();

        try {
            $query = "SELECT * FROM " . $this->database::TABLE_USUARIO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $usuario = new Usuario($row['id'], $row['nombre'], $row['apellido'], $row['email'], $row['ci'], $row['cargo_id']);
                return $usuario;
            }
        } catch (Exception $e) {
            error_log("Excepción en buscarUsuario: " . $e->getMessage());
        } finally {
            $bd->close();
        }

        return null;
    }

    public function editarUsuario($id, $nombre, $apellido, $email, $ci, $cargo_id): void
    {
        $bd = $this->database->getConnection();

        try {
            $query = "UPDATE " . $this->database::TABLE_USUARIO . " SET nombre = ?, apellido = ?, email = ?, ci = ?, cargo_id = ? WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("ssssii", $nombre, $apellido, $email, $ci, $cargo_id, $id);

            if ($stmt->execute()) {
                error_log("Usuario editado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al editar el usuario: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }

    public function eliminarUsuario($id): void
    {
        $bd = $this->database->getConnection();

        try {
            $query = "DELETE FROM " . $this->database::TABLE_USUARIO . " WHERE id = ?";
            $stmt = $bd->prepare($query);
            $stmt->bind_param("i", $id);

            if ($stmt->execute()) {
                error_log("Usuario eliminado con éxito");
            }
        } catch (Exception $e) {
            error_log("Excepción al eliminar el usuario: " . $e->getMessage());
        } finally {
            if (isset($stmt)) {
                $stmt->close();
            }
            $bd->close();
        }
    }
}
