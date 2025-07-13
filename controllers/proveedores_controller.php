<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../models/Proveedor.php';

class ProveedoresController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Proveedor();
    }

    public function index() {
        $proveedores = $this->modelo->listar();
        require_once __DIR__ . '/../views/partials/header.php';
        require_once __DIR__ . '/../views/proveedores/index.php';
        require_once __DIR__ . '/../views/partials/footer.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->modelo->crear(
                $_POST['nombre'],
                $_POST['contacto'],
                $_POST['telefono'],
                $_POST['correo'],
                $_POST['direccion']
            );
        }
        header('Location: index.php?controller=proveedores&action=index');
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->modelo->eliminar($_GET['id']);
        }
        header('Location: index.php?controller=proveedores&action=index');
    }
    public function editar() {
    if (!isset($_GET['id'])) {
        header('Location: index.php?controller=proveedores&action=index');
        return;
    }

    $proveedor = $this->modelo->obtenerPorId($_GET['id']);

    if (!$proveedor) {
        echo "Proveedor no encontrado.";
        return;
    }

    require_once __DIR__ . '/../views/partials/header.php';
    require_once __DIR__ . '/../views/proveedores/editar.php';
    require_once __DIR__ . '/../views/partials/footer.php';
}
    public function actualizar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->modelo->actualizar(
            $_POST['id'],
            $_POST['nombre'],
            $_POST['contacto'],
            $_POST['telefono'],
            $_POST['correo'],
            $_POST['direccion']
        );
    }
    header('Location: index.php?controller=proveedores&action=index');
}
}
?>
