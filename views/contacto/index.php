<div class="container">
  <h4 class="mb-3">Formulario de contacto</h4>
  <?php if (isset($_GET['exito'])): ?>
    <div class="alert alert-success">Mensaje enviado correctamente.</div>
  <?php endif; ?>
  <form action="index.php?controller=contacto&action=enviar" method="POST">
    <div class="mb-3">
      <label for="nombre">Nombres:</label>
      <input type="text" class="form-control" name="nombre" required>
    </div>
    <div class="mb-3">
      <label for="correo">Correo electrónico:</label>
      <input type="email" class="form-control" name="correo" required>
    </div>
    <div class="mb-3">
      <label for="asunto">Asunto:</label>
      <input type="text" class="form-control" name="asunto" required>
    </div>
    <div class="mb-3">
      <label for="mensaje">Mensaje:</label>
      <textarea class="form-control" name="mensaje" rows="4" required></textarea>
    </div>
    <button type="submit" class="btn btn-dark">Enviar</button>
  </form>
</div>
