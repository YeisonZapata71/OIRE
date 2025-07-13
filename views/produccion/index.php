<h4>Historial de Producción</h4>
<div class="mb-3 text-end">
    <a href="index.php?controller=produccion&action=crear" class="btn btn-success">
        <i class="bi bi-plus-circle me-1"></i> Crear nueva producción
    </a>
</div>

<table class="table table-striped table-bordered">
    <thead class="table-dark">
        <tr>
            <th>Perfume</th>
            <th>Cantidad</th>
            <th>Fecha</th>
            <th>Costo total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($producciones as $p): ?>
            <tr>
                <td><?= $p['perfume'] ?></td>
                <td><?= $p['cantidad'] ?></td>
                <td><?= $p['fecha_produccion'] ?></td>
                <td>$<?= number_format($p['costo_total'], 2) ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
