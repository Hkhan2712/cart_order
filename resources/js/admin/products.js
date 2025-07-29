import { setupDeleteButtons } from './shared/delete-handler.js';

document.addEventListener('DOMContentLoaded', () => {
    setupEditProductModal();
    setupDeleteButtons('.btn-delete-product');
});

const setupEditProductModal = () => {
    const editButtons = document.querySelectorAll('.btn-edit-product');
    const form = document.getElementById('editProductForm');

    if (!form) return;

    editButtons.forEach(button => {
        button.addEventListener('click', () => {
            form.action = button.dataset.action;
            document.getElementById('edit-product-id').value = button.dataset.id;
            document.getElementById('edit-product-name').value = button.dataset.name;
            document.getElementById('edit-product-slug').value = button.dataset.slug;
            document.getElementById('edit-product-price').value = button.dataset.price;
            document.getElementById('edit-product-sale-price').value = button.dataset.salePrice ?? '';
            document.getElementById('edit-product-weight').value = button.dataset.weight;
            document.getElementById('edit-product-unit').value = button.dataset.unit;
            document.getElementById('edit-product-stock').value = button.dataset.stockQuantity;
            document.getElementById('edit-product-category').value = button.dataset.categoryId;
            document.getElementById('edit-product-description').value = button.dataset.description ?? '';
            document.getElementById('edit-product-status').checked = button.dataset.status == '1';

            if (button.dataset.publishedAt) {
                const publishedAt = new Date(button.dataset.publishedAt);
                document.getElementById('edit-product-published-at').value = publishedAt.toISOString().slice(0, 16);
            } else {
                document.getElementById('edit-product-published-at').value = '';
            }
        });
    });
};