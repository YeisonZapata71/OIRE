<?php 
require_once __DIR__ . '/../partials/header.php'; ?>

<h4>Registrar insumo</h4>
<form action="index.php?controller=insumos&action=guardar" method="POST" class="mb-4">
    <div class="row">
        <div class="col-md-4 mb-2">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre del insumo" required>
        </div>
        <div class="col-md-2 mb-2">
            <select name="categoria" class="form-select" required>
                <option value="">Categoría</option>
                <option value="alcohol">Alcohol</option>
                <option value="esencia">Esencia</option>
                <option value="fijador">Fijador</option>
                <option value="activador">Activador</option>
                <option value="feromona">Feromona</option>
                <option value="frasco">Frasco</option>
                <option value="etiqueta">Etiqueta</option>
                <option value="caja">Caja</option>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <select name="proveedor_id" class="form-select" required>
                <option value="">Proveedor</option>
                <?php foreach ($proveedores as $prov): ?>
                    <option value="<?= $prov['id'] ?>"><?= htmlspecialchars($prov['nombre']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-1 mb-2">
            <input type="number" name="costo_unitario" step="0.01" class="form-control" placeholder="Costo" required>
        </div>
        <div class="col-md-1 mb-2">
            <input type="number" name="cantidad_disponible" class="form-control" placeholder="Stock" required>
        </div>
        <div class="col-md-1 mb-2">
            <input type="text" name="unidad_medida" class="form-control" placeholder="Unidad" required>
        </div>
    </div>
    <button class="btn btn-primary">Guardar</button>
</form>
<h4>Listado de insumos</h4>

<div class="table-responsive">
    <table class="table table-striped table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Nombre</th>
                <th>Categoría</th>
                <th>Proveedor</th>
                <th>Costo</th>
                <th>Stock</th>
                <th>Unidad</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($insumos as $item): ?>
                <tr>
                    <td data-label="Nombre"><?= htmlspecialchars($item['nombre']) ?></td>
                    <td data-label="Categoría"><?= ucfirst($item['categoria']) ?></td>
                    <td data-label="Proveedor"><?= htmlspecialchars($item['proveedor_nombre']) ?></td>
                    <td data-label="Costo">$<?= number_format($item['costo_unitario'], 2) ?></td>
                    <td data-label="Stock"><?= $item['cantidad_disponible'] ?></td>
                    <td data-label="Unidad"><?= $item['unidad_medida'] ?></td>
                    <td data-label="Acciones" class="text-center">
                        <a href="index.php?controller=insumos&action=editar&id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-warning me-1">
                            <i class="bi bi-pencil-square"></i>
                        </a>
                        <a href="index.php?controller=insumos&action=eliminar&id=<?= $item['id'] ?>" 
                           onclick="return confirm('¿Eliminar este insumo?')" 
                           class="btn btn-sm btn-outline-danger">
                            <i class="bi bi-trash"></i>
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

            <?php if (empty($insumos)): ?>
                <tr><td colspan="7" class="text-center text-muted">No hay insumos registrados aún.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
