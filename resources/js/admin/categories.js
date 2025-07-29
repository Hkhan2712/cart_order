document.addEventListener('DOMContentLoaded', () => {
    setupEditCategoryModal();
    setupDeleteButtons();
});

const showToast = (message, type = 'primary') => {
    const toastEl = document.getElementById('liveToast');
    const toastBody = document.getElementById('toast-message');

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

    // Clear old listener
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
    document.querySelectorAll('.btn-delete-category').forEach(button => {
        button.addEventListener('click', () => {
            const categoryName = button.dataset.name;
            const url = button.dataset.url;

            showConfirm(`Are you sure you want to delete "${categoryName}"?`, async (confirmed) => {
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
                        showToast('Category deleted!', 'success');
                        // Remove row
                        button.closest('tr').remove();
                    } else {
                        showToast(result.message || 'Delete failed!', 'danger');
                    }
                } catch (err) {
                    showToast('Error connecting to server!', 'danger');
                }
            });
        });
    });
};

const setupEditCategoryModal = () => {
    const editButtons = document.querySelectorAll('.btn-edit-category');
    const form = document.getElementById('editCategoryForm');

    if (!form) return;

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            form.action = button.dataset.action;
            document.getElementById('edit-category-id').value = button.dataset.id;
            document.getElementById('edit-category-name').value = button.dataset.name;
            document.getElementById('edit-category-parent').value = button.dataset.parentId ?? '';
            document.getElementById('edit-category-description').value = button.dataset.description ?? '';
            document.getElementById('edit-category-status').checked = button.dataset.status == '1';
        });
    });
};
