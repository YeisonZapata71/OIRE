<?php require_once __DIR__ . '/../partials/header.php'; ?>

<h4 class="mb-4">Selecciona un perfume para gestionar su fórmula</h4>

<?php if (empty($perfumes)): ?>
    <div class="alert alert-info">No hay perfumes registrados aún. Registra uno para poder asignar fórmulas.</div>
<?php else: ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php foreach($perfumes as $p): ?>
            <div class="col">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body">
                        <h5 class="card-title mb-1"><?= htmlspecialchars($p['nombre']) ?></h5>
                        <p class="text-muted mb-0"><i class="bi bi-gender-ambiguous me-1"></i> <?= ucfirst($p['genero']) ?> - <?= $p['presentacion'] ?></p>
                        <p class="small mt-2 text-secondary">Notas: <?= htmlspecialchars($p['notas_olfativas']) ?></p>
                        <a href="index.php?controller=formulas&action=index&id=<?= $p['id'] ?>" class="btn btn-outline-primary btn-sm mt-2">
                            <i class="bi bi-sliders me-1"></i> Ver fórmula
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
