document.addEventListener('DOMContentLoaded', () => {
    setupDeleteButtons();
});

const showToast = (message, type = 'primary') => {
    const toastEl = document.getElementById('liveToast');
    const toastBody = document.getElementById('toast-message');

    if (!toastEl || !toastBody) {
        alert(message);
        return;
    }

    toastBody.textContent = message;
    toastEl.className = `toast align-items-center text-bg-${type} border-0 slide-toast`;
    const toastBootstrap = new bootstrap.Toast(toastEl, { delay: 3000 });
    toastBootstrap.show();
};

const showConfirm = (message, callback) => {
    const confirmModal = document.getElementById('custom-confirm');
    const messageEl = document.getElementById('confirm-message');
    const okBtn = document.getElementById('confirm-ok-btn');

    messageEl.textContent = message;

    const newOkBtn = okBtn.cloneNode(true);
    okBtn.parentNode.replaceChild(newOkBtn, okBtn);

    newOkBtn.addEventListener('click', () => {
        const modal = bootstrap.Modal.getInstance(confirmModal);
        modal.hide();
        callback(true);
    });

    const modal = new bootstrap.Modal(confirmModal);
    modal.show();
};

const hideConfirm = () => {
    const modal = bootstrap.Modal.getInstance(document.getElementById('custom-confirm'));
    modal.hide();
};
window.hideConfirm = hideConfirm; 

const setupDeleteButtons = () => {
    document.querySelectorAll('.btn-delete').forEach(button => {
        button.addEventListener('click', () => {
            const itemName = button.dataset.name;
            const url = button.dataset.url;

            showConfirm(`Are you sure you want to delete "${itemName}"?`, async (confirmed) => {
                if (!confirmed) return;

                try {
                    const response = await fetch(url, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Accept': 'application/json'
                        },
                        body: new URLSearchParams({ _method: 'DELETE' })
                    });

                    const result = await response.json();

                    if (response.ok) {
                        showToast(result.message || 'Item deleted!', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 1000);
                    } else {
                        showToast(result.message || 'Delete failed!', 'danger');
                    }
                } catch (err) {
                    console.error(err);
                    showToast('Error connecting to server!', 'danger');
                }
            });
        });
    });
};