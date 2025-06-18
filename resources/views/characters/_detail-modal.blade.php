<!-- Modal -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitle">Detalle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="row g-3">
          <div class="col-md-4 text-center">
            <img id="modalImg" src="" class="img-fluid rounded" alt="">
          </div>
          <div class="col-md-8">
            <ul class="list-group list-group-flush">
              <li class="list-group-item"><strong>ID:</strong> <span id="m-id"></span></li>
              <li class="list-group-item"><strong>Estado:</strong> <span id="m-status"></span></li>
              <li class="list-group-item"><strong>Especie:</strong> <span id="m-species"></span></li>
              <li class="list-group-item"><strong>Tipo:</strong> <span id="m-type"></span></li>
              <li class="list-group-item"><strong>Sexo:</strong> <span id="m-gender"></span></li>
              <li class="list-group-item"><strong>Origen:</strong>
                <a id="m-origin" href="#" target="_blank"></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modalEl = document.getElementById('detailModal');
    const modal   = new bootstrap.Modal(modalEl);

    document.querySelectorAll('.btn-detail').forEach(btn => {
        btn.addEventListener('click', () => {
            document.getElementById('modalTitle').textContent = btn.dataset.name;
            document.getElementById('modalImg').src          = btn.dataset.image;
            document.getElementById('modalImg').alt          = btn.dataset.name;

            document.getElementById('m-id').textContent      = btn.dataset.id;
            document.getElementById('m-status').textContent  = btn.dataset.status;
            document.getElementById('m-species').textContent = btn.dataset.species;
            document.getElementById('m-type').textContent    = btn.dataset.type;
            document.getElementById('m-gender').textContent  = btn.dataset.gender;

            const originLink  = document.getElementById('m-origin');
            originLink.textContent = btn.dataset.originName;
            originLink.href        = btn.dataset.originUrl || '#';

            modal.show();
        });
    });
});
</script>
@endpush
