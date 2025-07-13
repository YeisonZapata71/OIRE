<h4>Registrar Pedido</h4>
<form action="index.php?controller=pedidos&action=guardar" method="POST">
    <div class="row mb-2">
        <div class="col-md-4"><input name="cliente_nombre" class="form-control" placeholder="Nombre" required></div>
        <div class="col-md-4"><input name="cliente_contacto" class="form-control" placeholder="Teléfono o correo"></div>
        <div class="col-md-4"><input name="direccion" class="form-control" placeholder="Dirección de entrega"></div>
    </div>

    <div class="row mb-2">
        <div class="col-md-3">
            <input type="number" name="descuento" class="form-control" placeholder="Descuento %" min="0" max="100" value="0">
        </div>
    </div>

    <div id="detalle">
        <div class="row mb-2 item align-items-end">
            <div class="col-md-6">
                <select name="perfume_id[]" class="form-select perfume-select" required>
                    <option value="">Seleccionar perfume</option>
                    <?php foreach ($perfumes as $p): ?>
                        <option value="<?= $p['id'] ?>" 
                                data-stock="<?= $p['stock'] ?>"
                                class="<?= ((int)$p['stock'] === 0 ? 'no-stock' : '') ?>">
                            <?= $p['nombre'] ?> (<?= $p['presentacion'] ?>) 
                            — <?= ((int)$p['stock'] > 0) ? "✅ Stock: {$p['stock']}" : "⚠️ Stock: 0 - Requiere producción" ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-md-4">
                <input type="number" name="cantidad[]" class="form-control" placeholder="Cantidad" required>
            </div>

            <div class="col-md-2">
                <button type="button" class="btn btn-danger btn-sm remove"><i class="bi bi-x"></i></button>
            </div>
        </div>
    </div>

    <div class="mt-3">
        <button type="button" class="btn btn-secondary btn-sm" onclick="addLinea()">+ Otra fragancia</button>
        <button type="submit" class="btn btn-primary mt-2 me-2">Registrar pedido</button>

        <button type="submit" name="permitir_sin_stock" value="1" class="btn btn-warning mt-2">
            <i class="bi bi-exclamation-triangle"></i> Registrar pedido sin stock
        </button>
    </div>
</form>

<script>
function addLinea() {
    const row = document.querySelector('.item').cloneNode(true);
    row.querySelectorAll('input').forEach(i => i.value = '');
    row.querySelector('select').selectedIndex = 0;
    document.getElementById('detalle').appendChild(row);

    // volver a asignar el evento remove
    row.querySelector('.remove').addEventListener('click', function () {
        if (document.querySelectorAll('.item').length > 1)
            this.closest('.item').remove();
    });
}

// Asignar evento inicial a botones remove
document.querySelectorAll('.remove').forEach(btn =>
    btn.addEventListener('click', function () {
        if (document.querySelectorAll('.item').length > 1)
            this.closest('.item').remove();
    })
);
</script>

<style>
/* Estilo para perfumes sin stock */
select option.no-stock {
    background-color: #fff3cd;
    color: #856404;
    font-weight: bold;
}
</style>
