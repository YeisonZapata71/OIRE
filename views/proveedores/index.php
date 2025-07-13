<?php require_once __DIR__ . '/../partials/header.php'; ?>

<div class="row">
    <div class="col-md-6 mb-4">
        <h4>Registrar nuevo proveedor</h4>
        <form action="index.php?controller=proveedores&action=guardar" method="POST">
            <div class="mb-2">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Contacto</label>
                <input type="text" name="contacto" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Correo</label>
                <input type="email" name="correo" class="form-control">
            </div>
            <div class="mb-2">
                <label class="form-label">Dirección</label>
                <textarea name="direccion" class="form-control"></textarea>
            </div>
            <button class="btn btn-primary mt-2">Guardar</button>
        </form>
    </div>

    <div class="col-md-6">
        <h4>Listado de proveedores</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Nombre</th>
                        <th>Contacto</th>
                        <th>Teléfono</th>
                        <th>Correo</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($proveedores as $prov): ?>
                        <tr>
                            <td data-label="Nombre"><?= htmlspecialchars($prov['nombre']) ?></td>
                            <td data-label="Contacto"><?= htmlspecialchars($prov['contacto']) ?></td>
                            <td data-label="Teléfono"><?= htmlspecialchars($prov['telefono']) ?></td>
                            <td data-label="Correo"><?= htmlspecialchars($prov['correo']) ?></td>
                            <td data-label="Acciones" class="text-center">
                                <a href="index.php?controller=proveedores&action=editar&id=<?= $prov['id'] ?>" 
                                   class="btn btn-sm btn-outline-warning me-1">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a href="index.php?controller=proveedores&action=eliminar&id=<?= $prov['id'] ?>" 
                                   onclick="return confirm('¿Eliminar este proveedor?')" 
                                   class="btn btn-sm btn-outline-danger">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <?php if (empty($proveedores)): ?>
                        <tr><td colspan="5" class="text-center text-muted">No hay proveedores registrados.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
