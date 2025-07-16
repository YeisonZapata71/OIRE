<?php
$moduloActivo = $_GET['controller'] ?? '';
require_once __DIR__ . '/../../helpers/permisos.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>OIRË Admin</title>
  <meta name="description" content="Sistema de gestión de perfumes OIRË">
  <meta name="author" content="Yeison Dariel Zapata Monsalve">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">


  <!-- Estilos globales -->
  <link rel="stylesheet" href="https://oire.devsolutionsweb.com/app/assets/css/styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light d-flex flex-column min-vh-100">
<!-- Navbar superior para móviles -->
<nav class="navbar navbar-dark bg-dark d-md-none">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <span class="navbar-brand ms-2">OIRË Admin</span>
  </div>
</nav>
<!-- Contenedor principal horizontal en md+ y vertical en sm -->
<div class="d-md-flex flex-md-row flex-column flex-grow-1">
  <!-- Sidebar -->
  <div class="offcanvas-md offcanvas-start bg-dark text-white" tabindex="-1" id="sidebarMenu">
    <div class="offcanvas-header d-md-none">
      <h5 class="offcanvas-title">OIRË Admin</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body p-3">
      <div class="text-center mb-4 d-none d-md-block">
        <img src="https://oire.devsolutionsweb.com/app/images/logo.jpg" alt="Logo OIRË" class="img-fluid mb-2" style="height: 50px;">
        <h6 class="mb-0">OIRË Admin</h6>
      </div>
      <ul class="nav flex-column gap-2">
        <li><a href="index.php?controller=dashboard&action=index" class="nav-link text-white <?= $moduloActivo === 'dashboard' ? 'active' : '' ?>"><i class="bi bi-house me-2"></i>Inicio</a></li>
        <?php if (tienePermiso('perfumes', 'ver')): ?>
        <li><a href="index.php?controller=perfumes&action=index" class="nav-link text-white <?= $moduloActivo === 'perfumes' ? 'active' : '' ?>"><i class="bi bi-droplet-half me-2"></i>Perfumes</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('insumos', 'ver')): ?>
        <li><a href="index.php?controller=insumos&action=index" class="nav-link text-white <?= $moduloActivo === 'insumos' ? 'active' : '' ?>"><i class="bi bi-box-seam me-2"></i>Insumos</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('proveedores', 'ver')): ?>
        <li><a href="index.php?controller=proveedores&action=index" class="nav-link text-white <?= $moduloActivo === 'proveedores' ? 'active' : '' ?>"><i class="bi bi-truck me-2"></i>Proveedores</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('formulas', 'ver')): ?>
        <li><a href="index.php?controller=formulas&action=index" class="nav-link text-white <?= $moduloActivo === 'formulas' ? 'active' : '' ?>"><i class="bi bi-flask me-2"></i>Fórmulas</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('produccion', 'ver')): ?>
        <li><a href="index.php?controller=produccion&action=index" class="nav-link text-white <?= $moduloActivo === 'produccion' ? 'active' : '' ?>"><i class="bi bi-cpu me-2"></i>Producción</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('produccion', 'ver')): ?>
        <li><a href="index.php?controller=produccion&action=crear" class="nav-link text-white ps-4"><i class="bi bi-plus-circle me-2"></i>Nueva producción</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('produccion', 'ver')): ?><li><a href="index.php?controller=produccion&action=seleccionar" class="nav-link text-white ps-4"><i class="bi bi-filter-square me-2"></i> Seleccionar producción</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('pedidos', 'ver')): ?>
        <li><a href="index.php?controller=pedidos&action=index" class="nav-link text-white <?= $moduloActivo === 'pedidos' ? 'active' : '' ?>"><i class="bi bi-cart-check me-2"></i>Pedidos</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('pedidos', 'ver')): ?>
        <li><a href="index.php?controller=pedidos&action=crear" class="nav-link text-white ps-4"><i class="bi bi-plus-circle me-2"></i>Nuevo pedido</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('ventas', 'ver')): ?>
        <li><a href="index.php?controller=ventas&action=index" class="nav-link text-white <?= $moduloActivo === 'ventas' ? 'active' : '' ?>"><i class="bi bi-receipt me-2"></i>Ventas</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('ventas', 'ver')): ?>
        <li><a href="index.php?controller=ventas&action=crear" class="nav-link text-white ps-4"><i class="bi bi-plus-circle me-2"></i> Nueva venta</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('usuarios', 'ver')): ?>
        <li><a href="index.php?controller=usuarios&action=index" class="nav-link text-white <?= $moduloActivo === 'usuarios' && ($_GET['action'] ?? '') === 'index' ? 'active' : '' ?>"><i class="bi bi-people me-2"></i>Usuarios</a></li>
        <?php endif; ?>
        <?php if (tienePermiso('inventario', 'ver')): ?>
        <li><a href="index.php?controller=inventario&action=index" class="nav-link text-white <?= $moduloActivo === 'inventario' ? 'active' : '' ?>"><i class="bi bi-archive me-2"></i>Inventario</a></li>
        <?php endif; ?>
        <li><a href="index.php?controller=contacto&action=index" class="nav-link text-white <?= $moduloActivo === 'contacto' ? 'active' : '' ?>"><i class="bi bi-envelope me-2"></i>Contacto</a></li>
        <li class="mt-4 border-top pt-3"><a href="logout.php" class="nav-link text-white"><i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión </a></li>
      </ul>
    </div>
  </div>
  <!-- Contenido -->
  <main class="flex-grow-1 p-4">