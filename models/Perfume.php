<?php
require_once __DIR__ . '/Database.php';

class Perfume {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function crear($nombre, $genero, $notas, $presentacion, $categoria) {
        $query = "INSERT INTO perfumes (nombre, genero, notas_olfativas, presentacion, categoria)
                  VALUES (:nombre, :genero, :notas_olfativas, :presentacion, :categoria)";
        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':genero' => $genero,
            ':notas_olfativas' => $notas,
            ':presentacion' => $presentacion,
            ':categoria' => $categoria
        ]);
    }

    public function listar() {
        $query = "SELECT * FROM perfumes ORDER BY id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminar($id) {
        $query = "DELETE FROM perfumes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([':id' => $id]);
    }

    public function obtenerPorId($id) {
        $query = "SELECT * FROM perfumes WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($id, $nombre, $genero, $notas, $presentacion, $categoria) {
        $query = "UPDATE perfumes SET nombre = :nombre, genero = :genero,
                  notas_olfativas = :notas, presentacion = :presentacion, categoria = :categoria WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([
            ':nombre' => $nombre,
            ':genero' => $genero,
            ':notas' => $notas,
            ':presentacion' => $presentacion,
            ':categoria' => $categoria,
            ':id' => $id
        ]);
    }

    public function listarConStock() {
        $query = "SELECT p.*, IFNULL(ip.cantidad_disponible, 0) AS stock
                  FROM perfumes p
                  LEFT JOIN inventario_perfumes ip ON p.id = ip.perfume_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function listarConStockBajo($umbral = 2) {
    $query = "SELECT p.id, p.nombre, p.presentacion, 
                     COALESCE(ip.cantidad_disponible, 0) AS stock
              FROM perfumes p
              LEFT JOIN inventario_perfumes ip ON p.id = ip.perfume_id
              WHERE COALESCE(ip.cantidad_disponible, 0) < :umbral";
    $stmt = $this->conn->prepare($query);
    $stmt->execute([':umbral' => $umbral]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function obtenerPrecioPorPresentacion($presentacion) {
        switch ($presentacion) {
            case '30ml': return 28000;
            case '50ml': return 40000;
            case '100ml': return 75000;
            case '150ml': return 110000;
            case '200ml': return 150000;
            case '260ml': return 180000;
            default: return 0;
        }
    }
}
?>
