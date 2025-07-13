<?php require_once __DIR__ . '/../partials/header.php'; ?>

<h4>Listado de Pedidos</h4>
<a href="index.php?controller=pedidos&action=crear" class="btn btn-success mb-3">
  <i class="bi bi-plus-circle"></i> Nuevo pedido
</a>

<div class="table-responsive">
  <table class="table table-hover align-middle">
    <thead class="table-dark">
      <tr>
        <th>#</th>
        <th>Cliente</th>
        <th>Fecha</th>
        <th>Estado</th>
        <th>Total</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($pedidos as $p): ?>
        <tr>
          <td data-label="#">#<?= $p['id'] ?></td>
          <td data-label="Cliente"><?= htmlspecialchars($p['cliente']) ?></td>
          <td data-label="Fecha"><?= date('d/m/Y', strtotime($p['fecha'])) ?></td>
          <td data-label="Estado">
            <span class="badge bg-<?= $p['estado'] === 'pendiente' ? 'warning' : 'success' ?>">
              <?= ucfirst($p['estado']) ?>
            </span>
          </td>
          <td data-label="Total">$<?= number_format($p['total'], 0, ',', '.') ?></td>
          <td data-label="Acciones">
            <div class="d-flex flex-wrap gap-1">
              <a href="index.php?controller=pedidos&action=ver&id=<?= $p['id'] ?>" class="btn btn-sm btn-primary" title="Ver"><i class="bi bi-eye"></i></a>
              <a href="index.php?controller=pedidos&action=pdf&id=<?= $p['id'] ?>" target="_blank" class="btn btn-sm btn-outline-secondary" title="PDF"><i class="bi bi-file-earmark-pdf"></i></a>
              <a href="index.php?controller=pedidos&action=actualizarEstado&id=<?= $p['id'] ?>&estado=en_proceso" class="btn btn-sm btn-warning">Procesar</a>
              <a href="index.php?controller=pedidos&action=actualizarEstado&id=<?= $p['id'] ?>&estado=entregado" class="btn btn-sm btn-success">Entregar</a>
              <a href="index.php?controller=pedidos&action=cambiarEstado&id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-success">
                <i class="bi bi-check2-circle"></i> Cambiar estado
              </a>
              <a href="index.php?controller=pedidos&action=facturar&id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-primary">
                <i class="bi bi-receipt-cutoff"></i> Facturar
              </a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>

      <?php if (empty($pedidos)): ?>
        <tr><td colspan="6" class="text-center text-muted">No hay pedidos registrados aún.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
