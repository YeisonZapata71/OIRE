<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../helpers/permisos.php';
require_once __DIR__ . '/../models/Pedido.php';
require_once __DIR__ . '/../models/Perfume.php';
require_once __DIR__ . '/../models/Inventario.php';
require_once __DIR__ . '/../models/InsumoFaltante.php';
require_once __DIR__ . '/../models/Venta.php';

class PedidosController {

    public function index() {
        if (!tienePermiso('pedidos', 'ver')) {
            header('Location: index.php?controller=dashboard&action=index');
            exit;
        }

        $modelo = new Pedido();
        $pedidos = $modelo->listar();
        require_once __DIR__ . '/../views/pedidos/index.php';
    }

    public function cambiarEstado() {
        if (!tienePermiso('pedidos', 'editar')) {
            header("Location: index.php?controller=dashboard&action=index");
            exit;
        }

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $modelo = new Pedido();
            $pedido = $modelo->obtener($id);

            if ($pedido) {
                $nuevoEstado = ($pedido['estado'] === 'pendiente') ? 'entregado' : 'pendiente';
                $modelo->actualizarEstado($id, $nuevoEstado);
            }
        }

        header("Location: index.php?controller=pedidos&action=index");
        exit;
    }

    public function crear() {
        $perfumeModel = new Perfume();
        $perfumes = $perfumeModel->listarConStock();
        require_once __DIR__ . '/../views/partials/header.php';
        require_once __DIR__ . '/../views/pedidos/crear.php';
        require_once __DIR__ . '/../views/partials/footer.php';
    }

    public function guardar() {
        $cliente = $_POST['cliente_nombre'];
        $contacto = $_POST['cliente_contacto'];
        $direccion = $_POST['direccion'];
        $descuento = $_POST['descuento'] ?? 0;
        $permitirSinStock = isset($_POST['permitir_sin_stock']) && $_POST['permitir_sin_stock'] == '1';

        $detalle = [];
        $inventarioModel = new Inventario();
        $faltanteModel = new InsumoFaltante();
        $pedidoModel = new Pedido();

        foreach ($_POST['perfume_id'] as $i => $perfume_id) {
            $cantidad = $_POST['cantidad'][$i];
            $stockDisponible = $inventarioModel->obtenerStockPorPerfume($perfume_id);

            if ($stockDisponible < $cantidad && !$permitirSinStock) {
                $_SESSION['error'] = "El perfume ID $perfume_id no tiene suficiente stock para completar el pedido.";
                header("Location: index.php?controller=pedidos&action=crear");
                exit;
            }

            $detalle[] = [
                'perfume_id' => $perfume_id,
                'cantidad' => $cantidad
            ];
        }

        // Crear pedido
        $pedidoId = $pedidoModel->crear($cliente, $contacto, $direccion, $detalle, $descuento);

        // Registrar insumos faltantes si hay permiso
        if ($permitirSinStock) {
            foreach ($detalle as $d) {
                $stockDisponible = $inventarioModel->obtenerStockPorPerfume($d['perfume_id']);
                if ($stockDisponible < $d['cantidad']) {
                    $faltanteModel->crear([
                        'pedido_id' => $pedidoId,
                        'perfume_id' => $d['perfume_id'],
                        'cantidad_faltante' => $d['cantidad'] - $stockDisponible
                    ]);
                }
            }
        }

        header("Location: index.php?controller=pedidos&action=index");
        exit;
    }

    public function actualizarEstado() {
        (new Pedido())->actualizarEstado($_GET['id'], $_GET['estado']);
        header("Location: index.php?controller=pedidos&action=index");
    }

    public function facturar() {
        $pedido_id = $_GET['id'];
        $pedidoModel = new Pedido();
        $ventaModel = new Venta();
        $perfumeModel = new Perfume();

        $pedido = $pedidoModel->listar()[$pedido_id - 1];
        $descuento = $pedido['descuento'];
        $detalles = $pedidoModel->detallesConPrecios($pedido_id);

        foreach ($detalles as &$d) {
            $presentacion = $d['presentacion'];
            $d['precio_unitario'] = $perfumeModel->obtenerPrecioPorPresentacion($presentacion);
        }

        if ($descuento > 0) {
            foreach ($detalles as &$d) {
                $d['precio_unitario'] *= (1 - $descuento / 100);
            }
        }

        $venta_id = $ventaModel->crearDesdePedido($pedido_id, $pedido['cliente_nombre'], $detalles);
        $pedidoModel->actualizarEstado($pedido_id, 'entregado');
        header("Location: pdf/factura.php?id=$venta_id");
    }
}
