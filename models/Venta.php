<?php
require_once __DIR__ . '/Database.php';

class Venta {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function crearVenta($cliente_nombre, $detalle, $total) {
        $stmt = $this->conn->prepare("INSERT INTO ventas (cliente_nombre, fecha_venta, total) 
                                      VALUES (:nombre, CURDATE(), :total)");
        $stmt->execute([
            ':nombre' => $cliente_nombre,
            ':total' => $total
        ]);
        $venta_id = $this->conn->lastInsertId();

        foreach ($detalle as $item) {
            $this->agregarDetalle($venta_id, $item['perfume_id'], $item['cantidad'], $item['precio']);
        }

        return $venta_id;
    }

    public function crearDesdePedido($pedido_id, $cliente_nombre, $detalles) {
    $stmt = $this->conn->prepare("INSERT INTO ventas (cliente_nombre, fecha_venta, total) 
                                  VALUES (:nombre, CURDATE(), 0)");
    $stmt->execute([':nombre' => $cliente_nombre]);
    $venta_id = $this->conn->lastInsertId();

    $total = 0;
    foreach ($detalles as $d) {
        $subtotal = $d['cantidad'] * $d['precio_unitario'];
        $total += $subtotal;

        $this->agregarDetalle($venta_id, $d['perfume_id'], $d['cantidad'], $d['precio_unitario']);
    }

    $stmt = $this->conn->prepare("UPDATE ventas SET total = :total WHERE id = :id");
    $stmt->execute([':total' => $total, ':id' => $venta_id]);

    return $venta_id;
}

    private function agregarDetalle($venta_id, $perfume_id, $cantidad, $precio) {
        $stmt = $this->conn->prepare("INSERT INTO detalle_venta (venta_id, perfume_id, cantidad, precio_unitario)
                                      VALUES (:venta, :perfume, :cantidad, :precio)");
        $stmt->execute([
            ':venta' => $venta_id,
            ':perfume' => $perfume_id,
            ':cantidad' => $cantidad,
            ':precio' => $precio
        ]);

        // Descontar del inventario
        $this->conn->prepare("UPDATE inventario_perfumes 
                              SET cantidad_disponible = cantidad_disponible - :cantidad 
                              WHERE perfume_id = :perfume_id")
                   ->execute([':cantidad' => $cantidad, ':perfume_id' => $perfume_id]);
    }

    public function listar() {
        $stmt = $this->conn->prepare("SELECT * FROM ventas ORDER BY id DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function detalles($venta_id) {
        $stmt = $this->conn->prepare("SELECT dv.*, p.nombre 
                                      FROM detalle_venta dv 
                                      JOIN perfumes p ON dv.perfume_id = p.id 
                                      WHERE dv.venta_id = :id");
        $stmt->execute([':id' => $venta_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
