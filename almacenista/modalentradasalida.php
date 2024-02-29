<div class="modal fade" id="Entrada" tabindex="-1" aria-labelledby="Entrada" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="Entrada">Agregar Categoría</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <!-- Formulario para agregar nueva categoría -->
          <form action="../database/insertarcatego.php" method="POST">
            <div class="mb-3">
              <label for="nombreCategoria" class="form-label">Nombre del Área:</label>
              <input type="text" class="form-control" id="catego" name="catego" required>
            </div>
            <button type="submit" class="btn btn-primary">Agregar</button>
          </form>
        </div>
      </div>
    </div>
</div>