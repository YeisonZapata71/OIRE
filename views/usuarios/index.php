<?php require_once __DIR__ . '/../partials/header.php'; ?>

<h4 class="mb-4">Administración de usuarios</h4>

<?php if (tienePermiso('usuarios', 'crear')): ?>
<a href="index.php?controller=usuarios&action=crear" class="btn btn-success btn-sm mb-3">
    <i class="bi bi-plus-circle"></i> Nuevo usuario
</a>
<?php endif; ?>

<div class="table-responsive">
<table class="table table-hover align-middle">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($usuarios as $u): ?>
            <tr>
                <td data-label="Nombre"><?= htmlspecialchars($u['nombre']) ?></td>
                <td data-label="Correo"><?= htmlspecialchars($u['correo']) ?></td>
                <td data-label="Rol"><?= ucfirst($u['rol']) ?></td>
                <td data-label="Acciones">
                    <?php if (tienePermiso('usuarios', 'editar')): ?>
                        <a href="index.php?controller=usuarios&action=editar&id=<?= $u['id'] ?>" class="btn btn-outline-warning btn-sm">
                            <i class="bi bi-pencil"></i>
                        </a>
                    <?php endif; ?>
                    
                    <?php if (tienePermiso('usuarios', 'permisos')): ?>
                        <a href="index.php?controller=usuarios&action=permisos&id=<?= $u['id'] ?>" class="btn btn-outline-primary btn-sm">
                            <i class="bi bi-shield-lock"></i> Permisos
                        </a>
                    <?php endif; ?>

                    <?php if (tienePermiso('usuarios', 'eliminar')): ?>
                        <a href="index.php?controller=usuarios&action=eliminar&id=<?= $u['id'] ?>" onclick="return confirm('¿Eliminar este usuario?')" class="btn btn-outline-danger btn-sm">
                            <i class="bi bi-trash"></i>
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($usuarios)): ?>
            <tr>
                <td colspan="4" class="text-center text-muted">No hay usuarios registrados aún.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
