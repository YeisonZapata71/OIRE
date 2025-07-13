<link rel="stylesheet" href="https://oire.devsolutionsweb.com/app/assets/css/styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <h4 class="mb-4 fw-bold"><i class="bi bi-pencil-square"></i> Editar perfume</h4>

    <form action="index.php?controller=perfumes&action=actualizar" method="POST" class="row g-3 mb-4">
        <input type="hidden" name="id" value="<?= $perfume['id'] ?>">

        <div class="col-12 col-md-6 col-lg-3">
            <input type="text" name="nombre" class="form-control" placeholder="Nombre del perfume" value="<?= htmlspecialchars($perfume['nombre']) ?>" required>
        </div>

        <div class="col-6 col-md-3 col-lg-2">
            <select name="genero" class="form-select" required>
                <option value="">Género</option>
                <option value="masculino" <?= $perfume['genero'] === 'masculino' ? 'selected' : '' ?>>Masculino</option>
                <option value="femenino" <?= $perfume['genero'] === 'femenino' ? 'selected' : '' ?>>Femenino</option>
                <option value="unisex" <?= $perfume['genero'] === 'unisex' ? 'selected' : '' ?>>Unisex</option>
            </select>
        </div>

        <div class="col-6 col-md-3 col-lg-2">
            <select name="presentacion" class="form-select" required>
                <option value="">Presentación</option>
                <?php foreach (["30ml", "50ml", "100ml", "150ml", "200ml", "260ml"] as $opcion): ?>
                    <option value="<?= $opcion ?>" <?= $perfume['presentacion'] === $opcion ? 'selected' : '' ?>><?= $opcion ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <select name="categoria" class="form-select" required>
                <option value="">Categoría</option>
                <option value="tradicional" <?= $perfume['categoria'] === 'tradicional' ? 'selected' : '' ?>>Tradicional</option>
                <option value="nicho" <?= $perfume['categoria'] === 'nicho' ? 'selected' : '' ?>>Nicho</option>
                <option value="arabe" <?= $perfume['categoria'] === 'arabe' ? 'selected' : '' ?>>Árabe</option>
            </select>
        </div>

        <div class="col-12 col-md-12 col-lg-6">
            <textarea name="notas_olfativas" rows="3" class="form-control" placeholder="Notas olfativas (breve descripción)" required><?= htmlspecialchars($perfume['notas_olfativas']) ?></textarea>
        </div>

        <div class="col-12 text-end">
            <button class="btn btn-primary"><i class="bi bi-save"></i> Guardar cambios</button>
            <a href="index.php?controller=perfumes&action=index" class="btn btn-secondary ms-2">Cancelar</a>
        </div>
    </form>