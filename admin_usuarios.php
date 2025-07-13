<?php require_once __DIR__ . '/../partials/header.php'; ?>
<h4 class="mb-4">Administración de usuarios</h4>
<a href="index.php?controller=usuarios&action=crear" class="btn btn-success btn-sm mb-3">
    <i class="bi bi-plus-circle"></i> Nuevo usuario
</a>

<table class="table table-hover align-middle">
    <thead>
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
                <td><?= htmlspecialchars($u['nombre']) ?></td>
                <td><?= htmlspecialchars($u['correo']) ?></td>
                <td><?= ucfirst($u['rol']) ?></td>
                <td>
                    <a href="index.php?controller=usuarios&action=editar&id=<?= $u['id'] ?>" class="btn btn-outline-warning btn-sm">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <a href="index.php?controller=usuarios&action=permisos&id=<?= $u['id'] ?>" class="btn btn-outline-primary btn-sm">
                        <i class="bi bi-shield-lock"></i> Permisos
                    </a>
                    <a href="index.php?controller=usuarios&action=eliminar&id=<?= $u['id'] ?>" onclick="return confirm('¿Eliminar este usuario?')" class="btn btn-outline-danger btn-sm">
                        <i class="bi bi-trash"></i>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($usuarios)): ?>
            <tr><td colspan="4" class="text-center text-muted">No hay usuarios registrados aún.</td></tr>
        <?php endif; ?>
    </tbody>
</table>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>
