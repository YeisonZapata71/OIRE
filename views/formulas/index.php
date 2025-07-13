<?php require_once __DIR__ . '/../partials/header.php'; ?>

<h4 class="mb-3">Fórmula de: <span class="text-primary fw-semibold"><?= htmlspecialchars($perfume['nombre']) ?></span></h4>

<form action="index.php?controller=formulas&action=guardar" method="POST" class="row g-2 mb-4 align-items-end">
    <input type="hidden" name="perfume_id" value="<?= $perfume['id'] ?>">
    <div class="col-md-6">
        <label class="form-label">Seleccionar insumo</label>
        <select name="insumo_id" class="form-select" required>
            <option value="">Seleccionar insumo</option>
            <?php foreach($insumos as $i): ?>
                <option value="<?= $i['id'] ?>"><?= $i['nombre'] ?> (<?= $i['unidad_medida'] ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="col-md-4">
        <label class="form-label">Cantidad</label>
        <input type="number" name="cantidad_utilizada" class="form-control" step="0.01" placeholder="Cantidad" required>
    </div>
    <div class="col-md-2">
        <button class="btn btn-success w-100"><i class="bi bi-plus-circle me-1"></i>Agregar</button>
    </div>
</form>

<table class="table table-hover align-middle">
    <thead class="table-light">
        <tr>
            <th>Insumo</th>
            <th>Cantidad</th>
            <th>Unidad</th>
            <th>Costo unitario</th>
            <th>Costo total</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $total = 0;
        foreach ($formula as $f):
            $costo = $f['cantidad_utilizada'] * $f['costo_unitario'];
            $total += $costo;
        ?>
            <tr>
                <td><?= $f['insumo_nombre'] ?></td>
                <td><?= $f['cantidad_utilizada'] ?></td>
                <td><?= $f['unidad_medida'] ?></td>
                <td>$<?= number_format($f['costo_unitario'], 2) ?></td>
                <td>$<?= number_format($costo, 2) ?></td>
                <td>
                    <a href="index.php?controller=formulas&action=eliminar&id=<?= $f['id'] ?>&perfume_id=<?= $perfume['id'] ?>" 
                       class="btn btn-outline-danger btn-sm" onclick="return confirm('¿Eliminar este componente?')">
                       <i class="bi bi-trash"></i></a>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="table-secondary fw-bold">
            <td colspan="4">Costo total estimado por unidad</td>
            <td colspan="2">$<?= number_format($total, 2) ?></td>
        </tr>
    </tbody>
</table>

<a href="index.php?controller=formulas&action=index" class="btn btn-outline-secondary mt-3">
    <i class="bi bi-arrow-left me-1"></i> Volver a selección de perfume
</a>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
