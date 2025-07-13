<div class="card shadow">
    <div class="card-body">
        <h1 class="display-6"><i class="bi bi-speedometer2"></i> Bienvenido al panel de OIRË Perfumería</h1>
        <p class="lead">Aquí podrás gestionar insumos, fórmulas, perfumes, producción y pedidos de forma modular y eficiente.</p>
        <hr>
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


