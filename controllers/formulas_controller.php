<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../models/Formula.php';
require_once __DIR__ . '/../models/Perfume.php';
require_once __DIR__ . '/../models/Insumo.php';

class FormulasController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Formula();
    }

    public function index() {
    if (!isset($_GET['id'])) {
        // No se pasó un ID de perfume, mostrar selección
        $perfumeModel = new Perfume();
        $perfumes = $perfumeModel->listar();
        $insumoModel = new Insumo();
        $insumos = $insumoModel->listar();


        require_once __DIR__ . '/../views/formulas/seleccionar_perfume.php';
        return;
    }

    // Si hay ID de perfume, continuar flujo normal de fórmula
    $id_perfume = intval($_GET['id']);

    // Aquí continúa tu lógica original para mostrar la fórmula del perfume
    // Por ejemplo:
    $formulaModel = new Formula();
    $formula = $formulaModel->listarPorPerfume($id_perfume);

    $perfumeModel = new Perfume(); // <--- Esta línea es necesaria
    $perfume = $perfumeModel->obtenerPorId($id_perfume);

    $insumoModel = new Insumo();
    $insumos = $insumoModel->listar();

require_once __DIR__ . '/../views/formulas/index.php';

}

    public function guardar() {
        $this->modelo->crear($_POST['perfume_id'], $_POST['insumo_id'], $_POST['cantidad_utilizada']);
        header("Location: index.php?controller=formulas&action=index&perfume_id=" . $_POST['perfume_id']);
    }

    public function eliminar() {
        if (isset($_GET['id']) && isset($_GET['perfume_id'])) {
            $this->modelo->eliminar($_GET['id']);
            header("Location: index.php?controller=formulas&action=index&perfume_id=" . $_GET['perfume_id']);
        }
    }
}
