<?php
require_once __DIR__ . '/Database.php';

class Pedido {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
}
    public function crear($cliente, $contacto, $direccion, $detalles, $descuento = 0) {
    $stmt = $this->conn->prepare("INSERT INTO pedidos 
        (cliente_nombre, cliente_contacto, direccion_entrega, estado, fecha_pedido, descuento)
        VALUES (:nombre, :contacto, :direccion, 'pendiente', CURDATE(), :descuento)");
    $stmt->execute([
        ':nombre' => $cliente,
        ':contacto' => $contacto,
        ':direccion' => $direccion,
        ':descuento' => $descuento
    ]);
    $pedido_id = $this->conn->lastInsertId();

    foreach ($detalles as $d) {
        $this->conn->prepare("INSERT INTO pedido_detalles (pedido_id, perfume_id, cantidad)
                              VALUES (:pedido, :perfume, :cantidad)")
                   ->execute([
                       ':pedido' => $pedido_id,
                       ':perfume' => $d['perfume_id'],
                       ':cantidad' => $d['cantidad']
                   ]);
    }

    return $pedido_id;
}
    public function listar() {
        $stmt = $this->conn->prepare("SELECT * FROM pedidos ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detalles($pedido_id) {
        $stmt = $this->conn->prepare("SELECT pd.*, p.nombre 
                                      FROM pedido_detalles pd
                                      JOIN perfumes p ON p.id = pd.perfume_id
                                      WHERE pd.pedido_id = :id");
        $stmt->execute([':id' => $pedido_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function actualizarEstado($id, $nuevoEstado) {
    $stmt = $this->db->prepare("UPDATE pedidos SET estado = :estado WHERE id = :id");
    return $stmt->execute([
        ':estado' => $nuevoEstado,
        ':id' => $id
    ]);
}
    public function detallesConPrecios($pedido_id) {
    $query = "SELECT pd.perfume_id, pd.cantidad, p.nombre, p.id, 0.00 AS precio_unitario
              FROM pedido_detalles pd
              JOIN perfumes p ON p.id = pd.perfume_id
              WHERE pedido_id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([':id' => $pedido_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
   }
}
