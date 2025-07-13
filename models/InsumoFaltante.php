<?php
class InsumoFaltante {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function listarPendientes() {
        $sql = "SELECT i.*, p.nombre AS nombre_perfume 
                FROM insumos_faltantes i 
                JOIN perfumes p ON p.id = i.perfume_id 
                WHERE i.estado = 'pendiente'";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($data) {
        $stmt = $this->db->prepare("INSERT INTO insumos_faltantes (pedido_id, perfume_id, cantidad_faltante) 
                                    VALUES (:pedido_id, :perfume_id, :cantidad)");
        $stmt->execute([
            ':pedido_id' => $data['pedido_id'],
            ':perfume_id' => $data['perfume_id'],
            ':cantidad' => $data['cantidad_faltante']
        ]);
    }
}
