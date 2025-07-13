<?php
require_once __DIR__ . '/../helpers/permisos.php';
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../models/Produccion.php';
require_once __DIR__ . '/../models/Perfume.php';
require_once __DIR__ . '/../models/Formula.php';
require_once __DIR__ . '/../models/Insumo.php';

class ProduccionController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Produccion();
    }

    public function index() {
        $producciones = $this->modelo->listar();
        require_once __DIR__ . '/../views/partials/header.php';
        require_once __DIR__ . '/../views/produccion/index.php';
        require_once __DIR__ . '/../views/partials/footer.php';
    }

    public function seleccionar() {
        if (!tienePermiso('produccion', 'ver')) {
            header("Location: index.php?controller=dashboard&action=index");
            exit;
        }

        $perfumeModel = new Perfume();
        $perfumes = $perfumeModel->listar();

        require_once __DIR__ . '/../views/partials/header.php';
        require_once __DIR__ . '/../views/produccion/seleccionar.php';
        require_once __DIR__ . '/../views/partials/footer.php';
    }

    public function verFormula() {
        $id = $_GET['perfume_id'];
        $presentacion = $_GET['presentacion'];
        $formulaModel = new Formula();
        $formula = $formulaModel->obtenerPorPerfumeYPresentacion($id, $presentacion);
        require_once __DIR__ . '/../views/produccion/ver_formula.php';
    }

    public function crear() {
        $perfumes = (new Perfume())->listar();
        require_once __DIR__ . '/../views/partials/header.php';
        require_once __DIR__ . '/../views/produccion/crear.php';
        require_once __DIR__ . '/../views/partials/footer.php';
    }

    public function guardar() {
        $perfume_id = $_POST['perfume_id'];
        $cantidad = $_POST['cantidad'];
        $presentacion = $_POST['presentacion'];

        $formulas = (new Formula())->listarPorPerfume($perfume_id);
        $total = 0;
        $produccion = new Produccion();

        // Validar disponibilidad de insumos
        $insumoModel = new Insumo();
        foreach ($formulas as $f) {
            $necesario = $f['cantidad_utilizada'] * $cantidad;
            $actual = $insumoModel->obtenerStock($f['insumo_id']);
            if ($actual < $necesario) {
                die("No hay suficiente stock de: " . $f['insumo_nombre']);
            }
        }

        // Descontar insumos y calcular costo
        foreach ($formulas as $f) {
            $necesario = $f['cantidad_utilizada'] * $cantidad;
            $insumoModel->descontarStock($f['insumo_id'], $necesario);
            $total += $f['costo_unitario'] * $necesario;
        }

        // Registrar producción
        $produccion->registrar($perfume_id, $cantidad, $total);

        // Aumentar inventario de perfumes
        $insumoModel->aumentarStockPerfume($perfume_id, $cantidad);

        header("Location: index.php?controller=produccion&action=index");
    }
}