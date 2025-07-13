<h4>Registrar Producción</h4>
<form action="index.php?controller=produccion&action=guardar" method="POST">
    <div class="row">
        <div class="col-md-6 mb-2">
            <select name="perfume_id" class="form-select" required>
                <option value="">Selecciona un perfume</option>
                <?php foreach ($perfumes as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['nombre'] ?> (<?= $p['presentacion'] ?>)</option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-3 mb-2">
            <input type="number" name="cantidad" class="form-control" placeholder="Unidades a producir" required>
        </div>
        <div class="col-md-3 mb-2">
            <button class="btn btn-success w-100">Registrar</button>
        </div>
    </div>
</form>
