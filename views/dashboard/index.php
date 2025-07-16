<div class="card shadow">
    <div class="card-body">
        <h1 class="display-6"><i class="bi bi-speedometer2"></i> Bienvenido al panel de OIRË Perfumería</h1>
        <p class="lead">Aquí podrás gestionar insumos, fórmulas, perfumes, producción y pedidos de forma modular y eficiente.</p>
        <hr>
        <div id="sliderDashboard" class="carousel slide my-4" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/img/slider1.png" class="d-block w-100 rounded" alt="Perfumería 1">
    </div>
    <div class="carousel-item">
      <img src="assets/img/slider2.png" class="d-block w-100 rounded" alt="Perfumería 2">
    </div>
    <div class="carousel-item">
      <img src="assets/img/slider3.png" class="d-block w-100 rounded" alt="Perfumería 3">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#sliderDashboard" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#sliderDashboard" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Siguiente</span>
  </button>
</div>

        <p class="text-muted">Sistema modular v1.0 | Desarrollado por Yeison Zapata Monsalve</p>
    </div>
</div>

<?php if (!empty($faltantes)): ?>
<h5 class="mt-4 mb-3"><i class="bi bi-tools"></i> Requieren producción</h5>
<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-xl-4 g-3">
    <?php foreach ($faltantes as $f): ?>
    <div class="col">
        <div class="card border-warning shadow-sm h-100">
            <div class="card-body">
                <h6 class="card-title text-warning fw-bold mb-1">
                    <?= htmlspecialchars($f['nombre_perfume']) ?>
                </h6>
                <p class="mb-1">
                    <i class="bi bi-hash"></i> Pedido: <strong>#<?= $f['pedido_id'] ?></strong><br>
                    <i class="bi bi-box"></i> Faltante: <strong><?= $f['cantidad_faltante'] ?></strong>
                </p>
                <small class="text-muted"><i class="bi bi-calendar-event"></i> <?= date('d M Y, H:i', strtotime($f['fecha'])) ?></small>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>
<?php else: ?>
<div class="alert alert-success shadow-sm mt-4">
    <i class="bi bi-check-circle-fill"></i> No hay solicitudes pendientes de producción.
</div>
<?php endif; ?>


