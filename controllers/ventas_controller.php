<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../models/Venta.php';
require_once __DIR__ . '/../models/Perfume.php';



class VentasController {
    public function index() {
        $ventas = (new Venta())->listar();
        require_once __DIR__ . '/../views/partials/header.php';
        require_once __DIR__ . '/../views/ventas/index.php';
        require_once __DIR__ . '/../views/partials/footer.php';
    }

    public function crear() {
        $perfumes = (new Perfume())->listarConStock();
        require_once __DIR__ . '/../views/partials/header.php';
        require_once __DIR__ . '/../views/ventas/crear.php';
        require_once __DIR__ . '/../views/partials/footer.php';
    }

    public function guardar() {
        $cliente = $_POST['cliente_nombre'];
        $perfume_ids = $_POST['perfume_id'];
        $cantidades = $_POST['cantidad'];
        $precios = $_POST['precio'];

        $detalle = [];
        $total = 0;
        for ($i = 0; $i < count($perfume_ids); $i++) {
            $detalle[] = [
                'perfume_id' => $perfume_ids[$i],
                'cantidad' => $cantidades[$i],
                'precio' => $precios[$i]
            ];
            $total += $cantidades[$i] * $precios[$i];
        }

        (new Venta())->crearVenta($cliente, $detalle, $total);
        header("Location: index.php?controller=ventas&action=index");
    }
}
