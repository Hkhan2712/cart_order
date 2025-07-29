import { hideConfirm, showConfirm } from './confirm.js';
import { showToast } from './toast.js';

export const setupDeleteButtons = (selector = '.btn-delete-item') => {
    document.querySelectorAll(selector).forEach(button => {
        button.addEventListener('click', () => {
            const name = button.dataset.name;
            const url = button.dataset.url;

            showConfirm(`Are you sure you want to delete "${name}"?`, async (confirmed) => {
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
                        showToast(`${name} deleted!`, 'success');
                        button.closest('tr')?.remove();
                    } else {
                        showToast(result.message || 'Delete failed!', 'danger');
                    }
                } catch (err) {
                    showToast('Error connecting to server!', 'danger');
                }
            });
        });
    });
    window.hideConfirm = hideConfirm;
};