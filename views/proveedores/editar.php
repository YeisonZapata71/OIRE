<h4>Editar Proveedor</h4>
<form action="index.php?controller=proveedores&action=actualizar" method="POST">
    <input type="hidden" name="id" value="<?= $proveedor['id'] ?>">
    <div class="mb-2">
        <label class="form-label">Nombre</label>
        <input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($proveedor['nombre']) ?>" required>
    </div>
    <div class="mb-2">
        <label class="form-label">Contacto</label>
        <input type="text" name="contacto" class="form-control" value="<?= htmlspecialchars($proveedor['contacto']) ?>">
    </div>
    <div class="mb-2">
        <label class="form-label">Teléfono</label>
        <input type="text" name="telefono" class="form-control" value="<?= htmlspecialchars($proveedor['telefono']) ?>">
    </div>
    <div class="mb-2">
        <label class="form-label">Correo</label>
        <input type="email" name="correo" class="form-control" value="<?= htmlspecialchars($proveedor['correo']) ?>">
    </div>
    <div class="mb-2">
        <label class="form-label">Dirección</label>
        <textarea name="direccion" class="form-control"><?= htmlspecialchars($proveedor['direccion']) ?></textarea>
    </div>
    <button class="btn btn-success mt-2"><i class="bi bi-save"></i> Actualizar</button>
    <a href="index.php?controller=proveedores&action=index" class="btn btn-secondary mt-2">Cancelar</a>
</form>
