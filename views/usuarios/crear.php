<?php require_once __DIR__ . '/../partials/header.php'; ?>

<h4 class="mb-4">Registrar nuevo usuario</h4>

<div class="card shadow-sm p-4">
<form action="index.php?controller=usuarios&action=guardar" method="POST" class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Nombre completo</label>
        <input type="text" name="nombre" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Correo electrónico</label>
        <input type="email" name="correo" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Contraseña</label>
        <input type="password" name="clave" class="form-control" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Rol</label>
        <select name="rol" class="form-select" required>
            <option value="">Seleccionar rol</option>
            <option value="admin">Administrador</option>
            <option value="asistente">Asistente</option>
            <option value="produccion">Producción</option>
        </select>
    </div>
    <div class="col-12 d-flex gap-2 mt-3">
        <button class="btn btn-success"><i class="bi bi-save me-1"></i> Guardar usuario</button>
        <a href="index.php?controller=usuarios&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
