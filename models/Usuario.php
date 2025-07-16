<?php
class Usuario {
    private $db;

    public function __construct() {
    require_once __DIR__ . '/Database.php';
    $this->db = (new Database())->getConnection();
}

    public function listar() {
        $stmt = $this->db->query("SELECT * FROM usuarios ORDER BY nombre ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crear($datos) {
    // Encriptar la clave antes de guardarla
    $claveHash = password_hash($datos['clave'], PASSWORD_BCRYPT);

    $stmt = $this->db->prepare("INSERT INTO usuarios (nombre, correo, clave, rol) VALUES (:nombre, :correo, :clave, :rol)");
    return $stmt->execute([
        ':nombre' => $datos['nombre'],
        ':correo' => $datos['correo'],
        ':clave' => $claveHash, // Guardar hash
        ':rol' => $datos['rol']
    ]);
}

    public function eliminar($id) {
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public function obtener($id) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id LIMIT 1");
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($datos) {
        $stmt = $this->db->prepare("UPDATE usuarios SET nombre = :nombre, correo = :correo, rol = :rol WHERE id = :id");
        return $stmt->execute([
            ':id' => $datos['id'],
            ':nombre' => $datos['nombre'],
            ':correo' => $datos['correo'],
            ':rol' => $datos['rol']
        ]);
    }

    public function obtenerPermisos($usuario_id) {
        $stmt = $this->db->prepare("SELECT * FROM permisos_modulo WHERE usuario_id = :usuario_id");
        $stmt->execute([':usuario_id' => $usuario_id]);
        $permisos = [];
        while ($p = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $permisos[$p['modulo']] = [
                'ver' => $p['puede_ver'],
                'editar' => $p['puede_editar']
            ];
        }
        return $permisos;
    }

    public function guardarPermisos($usuario_id, $permisos) {
        // Borrar permisos anteriores
        $this->db->prepare("DELETE FROM permisos_modulo WHERE usuario_id = :usuario_id")->execute([':usuario_id' => $usuario_id]);

        // Insertar nuevos permisos
        $stmt = $this->db->prepare("INSERT INTO permisos_modulo (usuario_id, modulo, puede_ver, puede_editar) VALUES (:usuario_id, :modulo, :ver, :editar)");

        foreach ($permisos as $modulo => $per) {
            $stmt->execute([
                ':usuario_id' => $usuario_id,
                ':modulo' => $modulo,
                ':ver' => isset($per['ver']) ? 1 : 0,
                ':editar' => isset($per['editar']) ? 1 : 0
            ]);
        }
    }
}
