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
            $this->modelo->crear(
                $_POST['nombre'],
                $_POST['genero'],
                $_POST['notas_olfativas'],
                $_POST['presentacion'],
                $_POST['categoria']
            );
        }
        header('Location: index.php?controller=perfumes&action=index');
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
        $this->modelo->actualizar(
            $_POST['id'],
            $_POST['nombre'],
            $_POST['genero'],
            $_POST['notas_olfativas'],
            $_POST['presentacion'],
            $_POST['categoria']
        );
    }
    header('Location: index.php?controller=perfumes&action=index');
}
}
