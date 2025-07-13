<?php require_once __DIR__ . '/../partials/header.php'; ?>

<h4 class="mb-4">Asignar permisos a: <strong><?= htmlspecialchars($usuario['nombre']) ?></strong></h4>

<div class="card shadow-sm p-4">
<form method="POST" action="index.php?controller=usuarios&action=guardarPermisos">
    <input type="hidden" name="usuario_id" value="<?= $usuario['id'] ?>">

    <div class="table-responsive">
    <table class="table table-bordered align-middle text-center">
        <thead class="table-light">
            <tr>
                <th class="text-start">Módulo</th>
                <th>Ver</th>
                <th>Crear</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $modulos = ['dashboard', 'perfumes', 'insumos', 'proveedores', 'formulas', 'produccion', 'pedidos', 'ventas', 'inventario', 'usuarios'];
            foreach ($modulos as $mod):
                $p = [
            'ver' => $permisos[$mod]['ver'] ?? 0,
            'crear' => $permisos[$mod]['crear'] ?? 0,
            'editar' => $permisos[$mod]['editar'] ?? 0,
            'eliminar' => $permisos[$mod]['eliminar'] ?? 0
            ];
            ?>
            <tr>
                <td class="text-start"><strong><?= ucfirst($mod) ?></strong></td>
                <?php foreach (['ver', 'crear', 'editar', 'eliminar'] as $accion): ?>
                    <td>
                        <div class="form-check d-flex justify-content-center">
                            <input type="checkbox" class="form-check-input" name="permisos[<?= $mod ?>][<?= $accion ?>]" value="1" <?= $p[$accion] ? 'checked' : '' ?>>
                        </div>
                    </td>
                <?php endforeach; ?>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </div>

    <div class="d-flex gap-2 mt-3">
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-save me-1"></i> Guardar permisos
        </button>
        <a href="index.php?controller=usuarios&action=index" class="btn btn-secondary">Cancelar</a>
    </div>
</form>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
