<?php
require_once __DIR__ . '/Database.php';

class Proveedor {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function crear($nombre, $contacto, $telefono, $correo, $direccion) {
        $query = "INSERT INTO proveedores (nombre, contacto, telefono, correo, direccion) 
                  VALUES (:nombre, :contacto, :telefono, :correo, :direccion)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':contacto' => $contacto,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':direccion' => $direccion
        ]);
    }

    public function listar() {
        $query = "SELECT * FROM proveedores ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPorId($id) {
        $query = "SELECT * FROM proveedores WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $contacto, $telefono, $correo, $direccion) {
        $query = "UPDATE proveedores SET nombre = :nombre, contacto = :contacto,
                  telefono = :telefono, correo = :correo, direccion = :direccion
                  WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':contacto' => $contacto,
            ':telefono' => $telefono,
            ':correo' => $correo,
            ':direccion' => $direccion,
            ':id' => $id
        ]);
    }

    public function eliminar($id) {
        $query = "DELETE FROM proveedores WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
}
?>
