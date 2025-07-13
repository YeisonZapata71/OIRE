<?php
require_once __DIR__ . '/../auth.php';
require_once __DIR__ . '/../helpers/permisos.php';
require_once __DIR__ . '/../models/Usuario.php';



class UsuariosController {

    public function index() {
    if (!tienePermiso('usuarios', 'ver')) {
        header("Location: index.php?controller=dashboard&action=index");
        exit;
    }
        $usuarioModel = new Usuario();
        $usuarios = $usuarioModel->listar();
        require_once __DIR__ . '/../views/usuarios/index.php';
    }

    public function crear() {
        if (!tienePermiso('usuarios', 'crear')) {
        header("Location: index.php?controller=dashboard&action=index");
        exit;
    }
        require_once __DIR__ . '/../views/usuarios/crear.php';
    }

    public function guardar() {
        if (!tienePermiso('usuarios', 'crear')) {
        header("Location: index.php?controller=dashboard&action=index");
        exit;
    }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $clavePlano = $_POST['clave'];
            $rol = $_POST['rol'];

            $claveHash = password_hash($clavePlano, PASSWORD_BCRYPT);

            $usuarioModel = new Usuario();
            $usuarioModel->crear([
                'nombre' => $nombre,
                'correo' => $correo,
                'clave' => $claveHash,
                'rol' => $rol
            ]);

            header("Location: index.php?controller=usuarios&action=index");
            exit;
        }
    }

    public function eliminar() {
         if (!tienePermiso('usuarios', 'eliminar')) {
        header("Location: index.php?controller=dashboard&action=index");
        exit;
    }
        if (isset($_GET['id'])) {
            $usuarioModel = new Usuario();
            $usuarioModel->eliminar($_GET['id']);
        }
        header("Location: index.php?controller=usuarios&action=index");
        exit;
    }

    public function editar() {
        if (!tienePermiso('usuarios', 'editar')) {
        header("Location: index.php?controller=dashboard&action=index");
        exit;
    }
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=usuarios&action=index");
            exit;
        }
        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->obtener($_GET['id']);
        require_once __DIR__ . '/../views/usuarios/editar.php';
    }

    public function actualizar() {
         if (!tienePermiso('usuarios', 'editar')) {
        header("Location: index.php?controller=dashboard&action=index");
        exit;
    }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $rol = $_POST['rol'];

            $usuarioModel = new Usuario();
            $usuarioModel->actualizar([
                'id' => $id,
                'nombre' => $nombre,
                'correo' => $correo,
                'rol' => $rol
            ]);

            header("Location: index.php?controller=usuarios&action=index");
            exit;
        }
    }

    public function permisos() {
        if (!tienePermiso('usuarios', 'permisos')) {
        header("Location: index.php?controller=dashboard&action=index");
        exit;
    }
        if (!isset($_GET['id'])) {
            header("Location: index.php?controller=usuarios&action=index");
            exit;
        }

        $usuarioModel = new Usuario();
        $usuario = $usuarioModel->obtener($_GET['id']);
        $permisos = $usuarioModel->obtenerPermisos($_GET['id']);
        require_once __DIR__ . '/../views/usuarios/permisos.php';
        // ✅ Aquí defines manualmente los módulos disponibles
        $modulos = [
        'dashboard', 'perfumes', 'insumos', 'proveedores',
        'formulas', 'produccion', 'pedidos', 'ventas', 'inventario', 'usuarios'];

        require_once __DIR__ . '/../views/usuarios/permisos.php';
        }

    public function guardarPermisos() {
        if (!tienePermiso('usuarios', 'permisos')) {
        header("Location: index.php?controller=dashboard&action=index");
        exit;
    }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario_id = $_POST['usuario_id'];
            $permisos = $_POST['permisos'] ?? [];

            $usuarioModel = new Usuario();
            $usuarioModel->guardarPermisos($usuario_id, $permisos);

            header("Location: index.php?controller=usuarios&action=index");
            exit;
        }
    }
}
