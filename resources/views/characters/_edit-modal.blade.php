<!-- Modal de Edición -->
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" id="editForm">
        @csrf
        @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Editar Personaje</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Nombre</label>
              <input type="text" name="name" class="form-control" id="edit-name" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Estado</label>
              <input type="text" name="status" class="form-control" id="edit-status">
            </div>
            <div class="col-md-6">
              <label class="form-label">Especie</label>
              <input type="text" name="species" class="form-control" id="edit-species">
            </div>
            <div class="col-md-6">
              <label class="form-label">Tipo</label>
              <input type="text" name="type" class="form-control" id="edit-type">
            </div>
            <div class="col-md-6">
              <label class="form-label">Género</label>
              <input type="text" name="gender" class="form-control" id="edit-gender">
            </div>
            <div class="col-md-6">
              <label class="form-label">Origen</label>
              <input type="text" name="origin_name" class="form-control" id="edit-origin-name">
            </div>
            <div class="col-md-12">
              <label class="form-label">URL Origen</label>
              <input type="url" name="origin_url" class="form-control" id="edit-origin-url">
            </div>
            <div class="col-md-12">
              <label class="form-label">URL Imagen</label>
              <input type="url" name="image_url" class="form-control" id="edit-image-url">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success">Guardar Cambios</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const editModalEl = document.getElementById('editModal');
    const editModal   = new bootstrap.Modal(editModalEl);
    const editForm    = document.getElementById('editForm');

    document.querySelectorAll('.btn-edit').forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.dataset.id;

            editForm.action = `/characters/${id}`; // ruta dinámica
            document.getElementById('edit-name').value        = btn.dataset.name;
            document.getElementById('edit-status').value      = btn.dataset.status;
            document.getElementById('edit-species').value     = btn.dataset.species;
            document.getElementById('edit-type').value        = btn.dataset.type;
            document.getElementById('edit-gender').value      = btn.dataset.gender;
            document.getElementById('edit-origin-name').value = btn.dataset.origin_name;
            document.getElementById('edit-origin-url').value  = btn.dataset.origin_url;
            document.getElementById('edit-image-url').value   = btn.dataset.image_url;

            editModal.show();
        });
    });
});
</script>
@endpush
