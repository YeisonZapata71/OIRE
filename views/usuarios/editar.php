<?php require_once __DIR__ . '/../partials/header.php'; ?>

<h4 class="mb-4">Editar usuario</h4>

<div class="card shadow-sm p-4">
<form action="index.php?controller=usuarios&action=actualizar" method="POST" class="row g-3">
    <input type="hidden" name="id" value="<?= $usuario['id'] ?>">

    <div class="col-md-6">
        <label class="form-label">Nombre completo</label>
        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Correo electrónico</label>
        <input type="email" name="correo" class="form-control" value="<?= htmlspecialchars($usuario['correo']) ?>" required>
    </div>

    <div class="col-md-6">
        <label class="form-label">Rol</label>
        <select name="rol" class="form-select" required>
            <option value="">Seleccionar rol</option>
            <option value="admin" <?= $usuario['rol'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
            <option value="asistente" <?= $usuario['rol'] === 'asistente' ? 'selected' : '' ?>>Asistente</option>
            <option value="produccion" <?= $usuario['rol'] === 'produccion' ? 'selected' : '' ?>>Producción</option>
        </select>
    </div>

    <div class="col-12 d-flex gap-2 mt-3">
        <button class="btn btn-primary"><i class="bi bi-save me-1"></i> Actualizar</button>
        <a href="index.php?controller=usuarios&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
