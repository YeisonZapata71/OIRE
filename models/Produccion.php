<?php
require_once __DIR__ . '/Database.php';

class Produccion {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function registrar($perfume_id, $cantidad, $costo_total) {
        $stmt = $this->conn->prepare("INSERT INTO produccion (perfume_id, cantidad, fecha_produccion, costo_total)
                                      VALUES (:perfume_id, :cantidad, CURDATE(), :costo_total)");
        $stmt->execute([
            ':perfume_id' => $perfume_id,
            ':cantidad' => $cantidad,
            ':costo_total' => $costo_total
        ]);
    }

    public function listar() {
        $stmt = $this->conn->prepare("SELECT p.*, pe.nombre AS perfume 
                                      FROM produccion p 
                                      JOIN perfumes pe ON p.perfume_id = pe.id 
                                      ORDER BY p.id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function descontarInsumos($perfume_id, $presentacion) {
    $formula = (new Formula())->obtenerPorPerfumeYPresentacion($perfume_id, $presentacion);
    foreach ($formula as $f) {
        $stmt = $this->db->prepare("UPDATE insumos SET cantidad = cantidad - :cant WHERE id = :id");
        $stmt->execute([':cant' => $f['cantidad'], ':id' => $f['insumo_id']]);
    }
}

}
