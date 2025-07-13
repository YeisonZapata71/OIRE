<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../models/Perfume.php';
require_once __DIR__ . '/../models/InsumoFaltante.php';
require_once __DIR__ . '/../views/partials/header.php';


class DashboardController {
    public function index() {
        $perfumeModel = new Perfume();
        $alertasStock = $perfumeModel->listarConStockBajo();

        $faltanteModel = new InsumoFaltante();
        $faltantes = $faltanteModel->listarPendientes();

        require_once __DIR__ . '/../views/dashboard/index.php';
    }
}
