<?php
require_once __DIR__ . '/Database.php';

class Insumo {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    public function crear($nombre, $categoria, $proveedor_id, $costo_unitario, $cantidad_disponible, $unidad_medida) {
        $query = "INSERT INTO insumos (nombre, categoria, proveedor_id, costo_unitario, cantidad_disponible, unidad_medida)
                  VALUES (:nombre, :categoria, :proveedor_id, :costo_unitario, :cantidad_disponible, :unidad_medida)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':categoria' => $categoria,
            ':proveedor_id' => $proveedor_id,
            ':costo_unitario' => $costo_unitario,
            ':cantidad_disponible' => $cantidad_disponible,
            ':unidad_medida' => $unidad_medida
        ]);
    }

    public function listar() {
        $query = "SELECT insumos.*, proveedores.nombre AS proveedor_nombre 
                  FROM insumos 
                  LEFT JOIN proveedores ON insumos.proveedor_id = proveedores.id
                  ORDER BY insumos.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($id) {
        $query = "DELETE FROM insumos WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }
    public function actualizar($id, $nombre, $categoria, $proveedor_id, $costo_unitario, $cantidad_disponible, $unidad_medida) {
    $query = "UPDATE insumos SET 
                nombre = :nombre,
                categoria = :categoria,
                proveedor_id = :proveedor_id,
                costo_unitario = :costo_unitario,
                cantidad_disponible = :cantidad_disponible,
                unidad_medida = :unidad_medida
              WHERE id = :id";

    $stmt = $this->conn->prepare($query);

    return $stmt->execute([
        ':nombre' => $nombre,
        ':categoria' => $categoria,
        ':proveedor_id' => $proveedor_id,
        ':costo_unitario' => $costo_unitario,
        ':cantidad_disponible' => $cantidad_disponible,
        ':unidad_medida' => $unidad_medida,
        ':id' => $id
    ]);
    }
    public function obtenerStock($id) {
    $stmt = $this->conn->prepare("SELECT cantidad_disponible FROM insumos WHERE id = :id");
    $stmt->execute([':id' => $id]);
    return $stmt->fetchColumn();
    }

    public function descontarStock($id, $cantidad) {
    $stmt = $this->conn->prepare("UPDATE insumos SET cantidad_disponible = cantidad_disponible - :cantidad WHERE id = :id");
    return $stmt->execute([':id' => $id, ':cantidad' => $cantidad]);
    }

    public function aumentarStockPerfume($perfume_id, $cantidad) {
    $stmt = $this->conn->prepare("INSERT INTO inventario_perfumes (perfume_id, cantidad_disponible)
                                  VALUES (:perfume_id, :cantidad)
                                  ON DUPLICATE KEY UPDATE cantidad_disponible = cantidad_disponible + :cantidad");
    return $stmt->execute([':perfume_id' => $perfume_id, ':cantidad' => $cantidad]);
}

}
?>
