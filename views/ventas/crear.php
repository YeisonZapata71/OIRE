<h4>Registrar venta</h4>

<form action="index.php?controller=ventas&action=guardar" method="POST">
    <div class="mb-3">
        <input type="text" name="cliente_nombre" class="form-control" placeholder="Nombre del cliente" required>
    </div>

    <div id="detalle">
        <div class="row mb-2 item">
            <div class="col-md-4 mb-2">
                <select name="perfume_id[]" class="form-select" required>
                    <option value="">Seleccione perfume</option>
                    <?php foreach ($perfumes as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['nombre'] ?> (Stock: <?= $p['stock'] ?>)</option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3 mb-2">
                <input type="number" name="cantidad[]" class="form-control" placeholder="Cantidad" required>
            </div>
            <div class="col-md-3 mb-2">
                <input type="number" name="precio[]" class="form-control" step="0.01" placeholder="Precio unitario" required>
            </div>
            <div class="col-md-2 d-flex align-items-center mb-2">
                <button type="button" class="btn btn-danger btn-sm remove"><i class="bi bi-x"></i></button>
            </div>
        </div>
    </div>

    <button type="button" class="btn btn-secondary btn-sm mb-2" onclick="addLinea()">+ Otro perfume</button>
    <br>
    <button class="btn btn-success">Registrar venta</button>
</form>

<script>
function addLinea() {
    const original = document.querySelector('.item');
    const row = original.cloneNode(true);

    row.querySelectorAll('input').forEach(input => input.value = '');
    row.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

    row.querySelector('.remove').addEventListener('click', function () {
        if (document.querySelectorAll('.item').length > 1) {
            this.closest('.item').remove();
        }
    });

    document.getElementById('detalle').appendChild(row);
}

// Activar eventos en los botones existentes al cargar
document.querySelectorAll('.remove').forEach(btn => {
    btn.addEventListener('click', function () {
        if (document.querySelectorAll('.item').length > 1) {
            this.closest('.item').remove();
        }
    });
});
</script>
