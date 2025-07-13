<h4>Editar Insumo</h4>
<form action="index.php?controller=insumos&action=actualizar" method="POST">
    <input type="hidden" name="id" value="<?= $insumo['id'] ?>">
    <div class="row">
        <div class="col-md-4 mb-2">
            <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($insumo['nombre']) ?>" required>
        </div>
        <div class="col-md-2 mb-2">
            <select name="categoria" class="form-select" required>
                <?php
                $categorias = ['alcohol', 'esencia', 'fijador', 'activador', 'feromona', 'frasco', 'etiqueta', 'caja'];
                foreach ($categorias as $cat) {
                    $selected = $insumo['categoria'] == $cat ? 'selected' : '';
                    echo "<option value='$cat' $selected>" . ucfirst($cat) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <select name="proveedor_id" class="form-select" required>
                <?php foreach ($proveedores as $prov): ?>
                    <option value="<?= $prov['id'] ?>" <?= $prov['id'] == $insumo['proveedor_id'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($prov['nombre']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-1 mb-2">
            <input type="number" name="costo_unitario" step="0.01" class="form-control" value="<?= $insumo['costo_unitario'] ?>" required>
        </div>
        <div class="col-md-1 mb-2">
            <input type="number" name="cantidad_disponible" class="form-control" value="<?= $insumo['cantidad_disponible'] ?>" required>
        </div>
        <div class="col-md-1 mb-2">
            <input type="text" name="unidad_medida" class="form-control" value="<?= $insumo['unidad_medida'] ?>" required>
        </div>
    </div>
    <button class="btn btn-success"><i class="bi bi-save"></i> Actualizar</button>
    <a href="index.php?controller=insumos&action=index" class="btn btn-secondary">Cancelar</a>
</form>
