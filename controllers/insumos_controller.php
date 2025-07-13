<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../models/Insumo.php';
require_once __DIR__ . '/../models/Proveedor.php';

class InsumosController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Insumo();
    }

    public function index() {
        $proveedores = (new Proveedor())->listar();
        $insumos = $this->modelo->listar();

        require_once __DIR__ . '/../views/partials/header.php';
        require_once __DIR__ . '/../views/insumos/index.php';
        require_once __DIR__ . '/../views/partials/footer.php';
    }

    public function guardar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->modelo->crear(
                $_POST['nombre'],
                $_POST['categoria'],
                $_POST['proveedor_id'],
                $_POST['costo_unitario'],
                $_POST['cantidad_disponible'],
                $_POST['unidad_medida']
            );
        }
        header('Location: index.php?controller=insumos&action=index');
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->modelo->eliminar($_GET['id']);
        }
        header('Location: index.php?controller=insumos&action=index');
    }
    public function editar() {
    if (!isset($_GET['id'])) {
        header('Location: index.php?controller=insumos&action=index');
        return;
    }

    $insumo = $this->modelo->listar(); // método temporal para obtener todos (ajustaremos)
    $insumo = array_filter($insumo, fn($i) => $i['id'] == $_GET['id']);
    $insumo = array_values($insumo)[0] ?? null;

    if (!$insumo) {
        echo "Insumo no encontrado.";
        return;
    }

    $proveedores = (new Proveedor())->listar();

    require_once __DIR__ . '/../views/partials/header.php';
    require_once __DIR__ . '/../views/insumos/editar.php';
    require_once __DIR__ . '/../views/partials/footer.php';
    }
    public function actualizar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->modelo->actualizar(
            $_POST['id'],
            $_POST['nombre'],
            $_POST['categoria'],
            $_POST['proveedor_id'],
            $_POST['costo_unitario'],
            $_POST['cantidad_disponible'],
            $_POST['unidad_medida']
        );
    }
    header('Location: index.php?controller=insumos&action=index');
    }
}
