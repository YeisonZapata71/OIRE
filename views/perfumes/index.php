<link rel="stylesheet" href="https://oire.devsolutionsweb.com/app/assets/css/styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <h4 class="mb-4 fw-bold"><i class="bi bi-droplet-half"></i> Registrar nuevo perfume</h4>
        <?php if (tienePermiso('perfumes', 'crear')): ?>
                   <form action="index.php?controller=perfumes&action=guardar" method="POST" class="row g-3 mb-4">
                    <div class="col-12 col-md-6 col-lg-3">
                        <input type="text" name="nombre" class="form-control" placeholder="Nombre del perfume" required>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <select name="genero" class="form-select" required>
                            <option value="">Género</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="unisex">Unisex</option>
                        </select>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <select name="presentacion" class="form-select" required>
                            <option value="">Presentación</option>
                            <option value="30ml">30ml</option>
                            <option value="50ml">50ml</option>
                            <option value="100ml">100ml</option>
                            <option value="150ml">150ml</option>
                            <option value="200ml">200ml</option>
                            <option value="260ml">260ml</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <select name="categoria" class="form-select" required>
                            <option value="">Categoría</option>
                            <option value="tradicional">Tradicional</option>
                            <option value="nicho">Nicho</option>
                            <option value="arabe">Árabe</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-12 col-lg-6">
                        <input type="text" name="notas_olfativas" class="form-control" placeholder="Notas olfativas (breve descripción)" required>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-primary"><i class="bi bi-save"></i> Guardar</button>
                    </div>
                </form>
                <?php endif; ?>

                <h4 class="mb-3 fw-bold"><i class="bi bi-list-check"></i> Listado de perfumes</h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped align-middle w-100">
                        <thead class="table-dark">
                            <tr>
                                <th>Nombre</th>
                                <th>Género</th>
                                <th>Notas</th>
                                <th>Presentación</th>
                                <th>Categoría</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($perfumes as $p): ?>
                                <tr>
                                    <td data-label="Nombre"><?= htmlspecialchars($p['nombre']) ?></td>
                                    <td data-label="Género"><?= ucfirst($p['genero']) ?></td>
                                    <td data-label="Notas"><?= htmlspecialchars($p['notas_olfativas']) ?></td>
                                    <td data-label="Presentación"><?= $p['presentacion'] ?></td>
                                    <td data-label="Categoría"><?= ucfirst($p['categoria']??'') ?></td>
                                    <td class="text-center">
                                       <?php if (tienePermiso('perfumes', 'editar')): ?> 
                                        <a href="index.php?controller=perfumes&action=editar&id=<?= $p['id'] ?>" 
                                           class="btn btn-sm btn-outline-primary me-2">
                                            <i class="bi bi-pencil-square"></i>
                                        </a>
                                        <?php endif; ?>
                                        <?php if (tienePermiso('perfumes', 'eliminar')): ?>
                                        <a href="index.php?controller=perfumes&action=eliminar&id=<?= $p['id'] ?>" 
                                           onclick="return confirm('¿Eliminar este perfume?')" 
                                           class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <?php if (empty($perfumes)): ?>
                                <tr><td colspan="6" class="text-center text-muted">No hay perfumes registrados aún.</td></tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

