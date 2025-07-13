<?php
class Database {
    private $conexion;

    public function __construct() {
        // Variables de conexión (deben estar dentro del constructor SIN usar 'private')
        $host = "localhost";
        $dbname = "devsolu1_oire";
        $user = "devsolu1_oire";
        $pass = "Oire2025**";

        try {
            $this->conexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error en la conexión: " . $e->getMessage());
        }
    }

    public function getConnection() {
        return $this->conexion;
    }
}
