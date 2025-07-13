<?php
class Inventario {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function obtenerStockPorPerfume($perfume_id) {
        $stmt = $this->db->prepare("SELECT cantidad_disponible FROM inventario_perfumes WHERE perfume_id = :id");
        $stmt->execute([':id' => $perfume_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['cantidad_disponible'] : 0;
    }
}
