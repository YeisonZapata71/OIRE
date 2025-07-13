<h4>Historial de ventas</h4>

<div class="mb-3 text-end">
    <a href="index.php?controller=ventas&action=crear" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i> Registrar nueva venta
    </a>
</div>

<div class="table-responsive">
<table class="table table-bordered table-striped align-middle">
    <thead class="table-dark">
        <tr>
            <th>Cliente</th>
            <th>Fecha</th>
            <th>Total</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ventas as $v): ?>
            <tr>
                <td data-label="Cliente"><?= htmlspecialchars($v['cliente_nombre']) ?></td>
                <td data-label="Fecha"><?= date('d/m/Y H:i', strtotime($v['fecha_venta'])) ?></td>
                <td data-label="Total">$<?= number_format($v['total'], 2, ',', '.') ?></td>
                <td data-label="Acciones">
                    <a href="pdf/factura.php?id=<?= $v['id'] ?>" class="btn btn-sm btn-outline-secondary" target="_blank">
                        <i class="bi bi-file-earmark-pdf"></i> PDF
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (empty($ventas)): ?>
            <tr>
                <td colspan="4" class="text-center text-muted">No hay ventas registradas aún.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>
</div>
