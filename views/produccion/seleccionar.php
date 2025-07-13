<div class="container mt-4">
  <h4>Seleccionar perfume para producción</h4>
  <input type="text" id="busqueda" class="form-control my-3" placeholder="🔍 Buscar perfume por nombre...">

  <div class="row g-3">
    <?php foreach ($perfumes as $p): ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-3">
        <div class="card-perfume shadow-sm">
          <div>
            <h5><?= htmlspecialchars($p['nombre']) ?></h5>
            <small><?= ucfirst($p['genero']) ?> - <?= ucfirst($p['categoria']) ?></small>
          </div>
          <form action="index.php?controller=produccion&action=verFormula" method="GET">
            <input type="hidden" name="perfume_id" value="<?= $p['id'] ?>">
            <select name="presentacion" class="form-select mb-2" required>
              <option value="">Seleccionar presentación</option>
              <?php foreach (['30ml', '50ml', '100ml', '150ml', '200ml', '260ml'] as $ml): ?>
                <option value="<?= $ml ?>"><?= $ml ?></option>
              <?php endforeach; ?>
            </select>
            <button class="btn btn-dark btn-sm">Ver fórmula</button>
          </form>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<script>
document.getElementById('buscador').addEventListener('input', function() {
  const filtro = this.value.toLowerCase();
  document.querySelectorAll('.card[data-nombre]').forEach(card => {
    const nombre = card.getAttribute('data-nombre');
    if (nombre.includes(filtro)) {
      card.parentElement.style.display = ''; // Mostrar columna
    } else {
      card.parentElement.style.display = 'none'; // Ocultar columna
    }
  });
});
</script>

