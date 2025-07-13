<h4>Fórmula para <?= $perfume['nombre'] ?> (<?= $presentacion ?>)</h4>
<table class="table table-bordered">
  <thead>
    <tr><th>Insumo</th><th>Cantidad</th><th>Unidad</th></tr>
  </thead>
  <tbody>
    <?php foreach($formula as $f): ?>
      <tr>
        <td><?= $f['insumo_nombre'] ?></td>
        <td><?= $f['cantidad'] ?></td>
        <td><?= $f['unidad'] ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<form action="index.php?controller=produccion&action=guardar" method="POST">
  <input type="hidden" name="perfume_id" value="<?= $perfume['id'] ?>">
  <input type="hidden" name="presentacion" value="<?= $presentacion ?>">
  <button class="btn btn-success">Confirmar Producción</button>
</form>
