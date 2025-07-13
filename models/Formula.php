<?php
require_once __DIR__ . '/Database.php';

class Formula {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function crear($perfume_id, $insumo_id, $cantidad_utilizada) {
        $query = "INSERT INTO formulas (perfume_id, insumo_id, cantidad_utilizada)
                  VALUES (:perfume_id, :insumo_id, :cantidad_utilizada)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':perfume_id' => $perfume_id,
            ':insumo_id' => $insumo_id,
            ':cantidad_utilizada' => $cantidad_utilizada
        ]);
    }

    public function listarPorPerfume($perfume_id) {
        $query = "SELECT f.*, i.nombre AS insumo_nombre, i.costo_unitario, i.unidad_medida
                  FROM formulas f
                  JOIN insumos i ON f.insumo_id = i.id
                  WHERE f.perfume_id = :perfume_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':perfume_id' => $perfume_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($id) {
        $stmt = $this->conn->prepare("DELETE FROM formulas WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
    public function obtenerPorPerfumeYPresentacion($perfume_id, $presentacion) {
    $stmt = $this->db->prepare("SELECT * FROM formulas WHERE perfume_id = :id AND presentacion = :tamano");
    $stmt->execute([
        ':id' => $perfume_id,
        ':tamano' => $presentacion
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}
