<?php
session_start();
require_once __DIR__ . '/models/Database.php';
$db = (new Database())->getConnection();



$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $correo = $_POST['correo'];
    $clave = $_POST['clave'];

    $db = (new Database())->getConnection();
    $stmt = $db->prepare("SELECT * FROM usuarios WHERE correo = :correo LIMIT 1");
    $stmt->execute([':correo' => $correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario && password_verify($clave, $usuario['clave'])) {
    $_SESSION['usuario'] = [
        'id' => $usuario['id'],
        'nombre' => $usuario['nombre'],
        'correo' => $usuario['correo'],
        'rol' => $usuario['rol']
    ];

    // Cargar permisos desde tabla usuario_permisos
    $stmtPermisos = $db->prepare("SELECT modulo, accion FROM usuario_permisos WHERE usuario_id = ?");
    $stmtPermisos->execute([$usuario['id']]);
    $permisos = $stmtPermisos->fetchAll(PDO::FETCH_ASSOC);

    // ✅ Nueva forma estructurada para compatibilidad con `tienePermiso()`
    $_SESSION['permisos'] = [];

    foreach ($permisos as $permiso) {
    $modulo = $permiso['modulo'];
    $accion = $permiso['accion'];
    $_SESSION['permisos'][$modulo][$accion] = true;
    }

    header("Location: index.php");
    exit;
}
    } else {
        $error = "Correo o contraseña incorrectos.";
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login - OIRË</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', sans-serif;
            height: 100vh;
        }
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.08);
        }
        .login-card h4 {
            font-weight: 600;
            margin-bottom: 20px;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-height: 80px;
        }
        .btn-dark {
            background-color: #212529;
            border: none;
        }
        .btn-dark:hover {
            background-color: #1a1e21;
        }
    </style>
</head>
<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">
  <div class="card p-4 shadow" style="min-width: 350px;">
    <h5 class="mb-3 text-center">Iniciar sesión</h5>
    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>
    <?php require_once __DIR__ . '/../helpers/csrf.php'; ?>
    <?php $token = generarToken(); ?>
    <form method="POST">
      <div class="mb-3">
        <label class="form-label">Correo electrónico</label>
        <input type="email" name="correo" class="form-control" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($token) ?>">
        <input type="password" name="clave" class="form-control" required>
      </div>
      <button class="btn btn-dark w-100">Entrar</button>
    </form>
  </div>
</body>
</html>
