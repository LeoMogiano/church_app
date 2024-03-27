<?php

class IglesiaDB
{
    const DATABASE_NOMBRE = "mvciglesia"; // Nombre de la base de datos sin la extensión .db ( NO ES ARCHIVO)
    const TABLE_TIPO_RELACION = "tipos_relacion";
    const TABLE_CARGO = "cargos";
    const TABLE_USUARIO = "usuarios";
    const TABLE_EVENTO = "eventos";
    const TABLE_INGRESO = "ingresos";
    const TABLE_RELACION = "relaciones";
    const TABLE_DETALLE_INGRESO = "detalle_ingreso";

    public function __construct()
    {
    }


    public function getConnection() : mysqli
    {
        $dbConfig = [
            'host' => 'localhost', // MacOS 127.0.0.1
            'username' => 'root',
            'password' => '',
            'database' => self::DATABASE_NOMBRE,
        ];

        $conn = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password']);

        if ($conn->connect_error) {
            die("Error de conexión: " . $conn->connect_error);
        }

        
        $this->createDatabase($conn, $dbConfig['database']);

        $conn->select_db($dbConfig['database']);

        // Verificar la existencia de todas las tablas
        $tables = [
            self::TABLE_TIPO_RELACION,
            self::TABLE_CARGO,
            self::TABLE_USUARIO,
            self::TABLE_EVENTO,
            self::TABLE_INGRESO,
            self::TABLE_RELACION,
            self::TABLE_DETALLE_INGRESO
        ];

        foreach ($tables as $table) {
            if (!$this->tableExists($conn, $table)) {
                $this->createTables($conn);
                /* break;  // Salir del bucle si se crea una tabla */
            }
        }

        return $conn;
    }

    public function createDatabase(mysqli $conn,string $databaseName) : void
    {
        // Verificar si la base de datos ya existe
        $checkDatabaseQuery = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$databaseName'";
        $result = $conn->query($checkDatabaseQuery);

        if ($result->num_rows === 0) {
            // La base de datos no existe, procede a crearla
            $createDatabaseQuery = "CREATE DATABASE $databaseName";

            if ($conn->query($createDatabaseQuery) === TRUE) {
                error_log("Base de datos '$databaseName' creada con éxito");
            } else {
                error_log("Error al crear la base de datos: " . $conn->error);
            }
        } else {
            error_log("La base de datos '$databaseName' ya existe, no se creó nuevamente.");
        }
    }

    public function createTables($conn) : void
    {

        $createTableQueryTiposRelacion = " CREATE TABLE IF NOT EXISTS " . self::TABLE_TIPO_RELACION . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255)
        )";

        // Consulta SQL para crear la tabla "cargos" si no existe
        $createTableQueryCargos = " CREATE TABLE IF NOT EXISTS " . self::TABLE_CARGO . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255),
        descripcion VARCHAR(255)
        )";

        // Consulta SQL para crear la tabla "usuarios" si no existe
        $createTableQueryUsuarios = " CREATE TABLE IF NOT EXISTS " . self::TABLE_USUARIO . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255),
        apellido VARCHAR(255),
        email VARCHAR(255),
        ci VARCHAR(255),
        cargo_id INT,
        FOREIGN KEY (cargo_id) REFERENCES " . self::TABLE_CARGO . "(id)
        )";

        // Consulta SQL para crear la tabla "eventos" si no existe
        $createTableQueryEventos = " CREATE TABLE IF NOT EXISTS " . self::TABLE_EVENTO . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nombre VARCHAR(255),
        fecha DATE,
        descripcion VARCHAR(255),
        usuario_id INT,
        FOREIGN KEY (usuario_id) REFERENCES " . self::TABLE_USUARIO . "(id)
        )";

        // Consulta SQL para crear la tabla "ingresos" si no existe
        $createTableQueryIngresos = " CREATE TABLE IF NOT EXISTS " . self::TABLE_INGRESO . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        tipo_ingreso VARCHAR(255),
        monto DECIMAL(10,2),
        evento_id INT,
        FOREIGN KEY (evento_id) REFERENCES " . self::TABLE_EVENTO . "(id)
        )";
   

        // Consulta SQL para crear la tabla "relaciones" si no existe
        $createTableQueryRelaciones = " CREATE TABLE IF NOT EXISTS " . self::TABLE_RELACION . " (
        id INT AUTO_INCREMENT PRIMARY KEY,
        usuario_a INT,
        usuario_b INT,
        tipo_relacion_a INT,
        tipo_relacion_b INT,
        FOREIGN KEY (usuario_a) REFERENCES " . self::TABLE_USUARIO . "(id),
        FOREIGN KEY (usuario_b) REFERENCES " . self::TABLE_USUARIO . "(id),
        FOREIGN KEY (tipo_relacion_a) REFERENCES " . self::TABLE_TIPO_RELACION . "(id),
        FOREIGN KEY (tipo_relacion_b) REFERENCES " . self::TABLE_TIPO_RELACION . "(id)
        )";

       

        $conn->query($createTableQueryTiposRelacion);
        $conn->query($createTableQueryCargos);
        $conn->query($createTableQueryUsuarios);
        $conn->query($createTableQueryEventos);
        $conn->query($createTableQueryIngresos);
        $conn->query($createTableQueryRelaciones);
       

        error_log("Tablas creadas con éxito");
    }

    /* private function databaseExists($conn)
    {
        $result = $conn->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'ventasdb'");
        return $result->num_rows > 0;
    }
 */
    private function tableExists(mysqli $conn, string $tableName) : bool
    {
        $result = $conn->query("SHOW TABLES LIKE '$tableName'");
        return $result->num_rows > 0;
    }
}
