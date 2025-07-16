<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../models/Perfume.php';


class PerfumesController {
    private $modelo;

    public function __construct() {
        $this->modelo = new Perfume();
    }

    public function index() {
        $perfumes = $this->modelo->listar();
        require_once __DIR__ . '/../views/partials/header.php';
        require_once __DIR__ . '/../views/perfumes/index.php';
        require_once __DIR__ . '/../views/partials/footer.php';
    }

    public function guardar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__ . '/../helpers/validacion.php';

        $nombre = limpiar($_POST['nombre'] ?? '');
        $genero = limpiar($_POST['genero'] ?? '');
        $notas = limpiar($_POST['notas_olfativas'] ?? '');
        $presentacion = intval($_POST['presentacion'] ?? 0);
        $categoria = limpiar($_POST['categoria'] ?? '');

        $errores = [];

        if (empty($nombre) || strlen($nombre) > 100) $errores[] = "Nombre inválido.";
        if (!validarGenero($genero)) $errores[] = "Género inválido.";
        if (!validarPresentacion($presentacion)) $errores[] = "Presentación fuera de rango.";
        if (!validarCategoria($categoria)) $errores[] = "Categoría inválida.";

        if (!empty($errores)) {
            // Mostrar errores directamente o redirigir con mensaje
            echo "<div class='alert alert-danger'>" . implode("<br>", $errores) . "</div>";
            return;
        }

        $this->modelo->crear($nombre, $genero, $notas, $presentacion, $categoria);
        header('Location: index.php?controller=perfumes&action=index');
        exit;
    }
}


    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->modelo->eliminar($_GET['id']);
        }
        header('Location: index.php?controller=perfumes&action=index');
    }
    public function editar() {
    if (!isset($_GET['id'])) {
        header('Location: index.php?controller=perfumes&action=index');
        return;
    }

    $perfume = $this->modelo->obtenerPorId($_GET['id']);
    if (!$perfume) {
        echo "Perfume no encontrado.";
        return;
    }

    require_once __DIR__ . '/../views/partials/header.php';
    require_once __DIR__ . '/../views/perfumes/editar.php';
    require_once __DIR__ . '/../views/partials/footer.php';
    }

    public function actualizar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once __DIR__ . '/../helpers/validacion.php';

        $id = intval($_POST['id']);
        $nombre = limpiar($_POST['nombre']);
        $genero = limpiar($_POST['genero']);
        $notas = limpiar($_POST['notas_olfativas']);
        $presentacion = intval($_POST['presentacion']);
        $categoria = limpiar($_POST['categoria']);

        $errores = [];

        if ($id <= 0) $errores[] = "ID inválido.";
        if (empty($nombre) || strlen($nombre) > 100) $errores[] = "Nombre inválido.";
        if (!validarGenero($genero)) $errores[] = "Género inválido.";
        if (!validarPresentacion($presentacion)) $errores[] = "Presentación fuera de rango.";
        if (!validarCategoria($categoria)) $errores[] = "Categoría inválida.";

        if (!empty($errores)) {
            echo "<div class='alert alert-danger'>" . implode("<br>", $errores) . "</div>";
            return;
        }

        $this->modelo->actualizar($id, $nombre, $genero, $notas, $presentacion, $categoria);
        header('Location: index.php?controller=perfumes&action=index');
        exit;
    }
}
}
