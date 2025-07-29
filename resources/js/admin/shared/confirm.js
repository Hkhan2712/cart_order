export const showConfirm = (message, onConfirm) => {
    const confirmModal = document.getElementById('custom-confirm');
    const messageEl = document.getElementById('confirm-message');
    const okBtn = document.getElementById('confirm-ok-btn');

    messageEl.textContent = message;

    // Reset listener
    const newOkBtn = okBtn.cloneNode(true);
    okBtn.parentNode.replaceChild(newOkBtn, okBtn);

    newOkBtn.addEventListener('click', () => {
        bootstrap.Modal.getInstance(confirmModal).hide();
        onConfirm(true);
    });

    const modal = new bootstrap.Modal(confirmModal);
    modal.show();
};

export const hideConfirm = () => {
    const modal = bootstrap.Modal.getInstance(document.getElementById('custom-confirm'));
    modal.hide();
};