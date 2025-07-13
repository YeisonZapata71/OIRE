<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../models/Insumo.php';
require_once __DIR__ . '/../models/Perfume.php';



class InventarioController {
    public function index() {
        $insumos = (new Insumo())->listar();
        $perfumes = (new Perfume())->listarConStock();

        require_once __DIR__ . '/../views/partials/header.php';
        require_once __DIR__ . '/../views/inventario/index.php';
        require_once __DIR__ . '/../views/partials/footer.php';
    }
}
