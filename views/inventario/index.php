<h4>Inventario de Perfumes</h4>
<table class="table table-bordered table-hover">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Género</th>
            <th>Presentación</th>
            <th>Stock disponible</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($perfumes as $p): ?>
            <tr class="<?= $p['stock'] < 10 ? 'table-warning' : '' ?>">
                <td><?= htmlspecialchars($p['nombre']) ?></td>
                <td><?= ucfirst($p['genero']) ?></td>
                <td><?= $p['presentacion'] ?></td>
                <td><?= $p['stock'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h4 class="mt-5">Inventario de Insumos</h4>
<table class="table table-bordered table-striped">
    <thead class="table-dark">
        <tr>
            <th>Nombre</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Unidad</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($insumos as $i): ?>
            <tr class="<?= $i['cantidad_disponible'] < 10 ? 'table-danger' : '' ?>">
                <td><?= htmlspecialchars($i['nombre']) ?></td>
                <td><?= ucfirst($i['categoria']) ?></td>
                <td><?= $i['cantidad_disponible'] ?></td>
                <td><?= $i['unidad_medida'] ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
