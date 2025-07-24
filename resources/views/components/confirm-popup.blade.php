<div id="custom-confirm" class="modal fade" tabindex="-1" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content shadow">
      <div class="modal-header">
        <h5 class="modal-title">Confirm</h5>
        <button type="button" class="btn-close" onclick="hideConfirm()"></button>
      </div>
      <div class="modal-body">
        <p id="confirm-message">Are you sure remove item from the cart ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" onclick="hideConfirm()">Cancel</button>
        <button type="button" class="btn btn-danger" id="confirm-ok-btn">Confirm</button>
      </div>
    </div>
  </div>
</div>