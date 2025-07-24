document.addEventListener('DOMContentLoaded', function () {
    setupAddToCartButtons();
    setupMiniCartOnOffcanvasShow();
    setupQuantityButtons();
    setupRemoveButtons();
});

const showToast = (message, type = 'primary') => {
    const toastEl = document.getElementById('liveToast');
    const toastBody = document.getElementById('toast-message');

    toastBody.textContent = message;

    // Set background color class
    toastEl.className = `toast align-items-center text-bg-${type} border-0 slide-toast`;

    const toastBootstrap = new bootstrap.Toast(toastEl, {
        delay: 3000, // auto close after 3s
    });

    toastBootstrap.show();
}

const setupAddToCartButtons = () => {
    document.querySelectorAll('.btn-cart').forEach(button => {
        button.addEventListener('click', async function (e) {
            e.preventDefault();

            let productId, quantity;

            const productCard = this.closest('.product-item');
            if (productCard) {
                quantity = productCard.querySelector('input.quantity')?.value || 1;
                productId = productCard.dataset.productId;
            } else {
               
                quantity = document.querySelector('#quantity')?.value || 1;
                
                productId = this.dataset.productId;

                if (!productId) {
                    console.error('Product not found!');
                    alert('No defined product');
                    return;
                }
            }

            try {
                const response = await fetch('/cart/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                });

                const result = await response.json();
                if (response.ok) {
                    showToast('Added item to the cart!', 'success');
                    loadMiniCart();
                } else {
                    alert(result.message || 'Failure add to cart!');
                }
            } catch (err) {
                alert('Error connected with server.');
            }
        });
    });
}

const removeCartItem = async (productId) => {
    showConfirm('Bạn có chắc chắn muốn xóa sản phẩm này không?', async (confirmed) => {
        if (!confirmed) return;

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        try {
            const response = await fetch('/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ product_id: productId })
            });

            const result = await response.json();

            if (response.ok && result.success) {
                const removeBtn = document.querySelector(`.remove-item[data-id="${productId}"]`);
                const productRow = removeBtn?.closest('.row.mb-4');
                const hrElement = productRow?.nextElementSibling;
                
                if (productRow) productRow.remove();
                if (hrElement?.tagName === 'HR') hrElement.remove();

                document.querySelector('.summary-subtotal').textContent = result.data.subtotal_formatted;
                document.querySelector('.cart-vat').textContent = result.data.vat_formatted;
                document.querySelector('.cart-total-vat').textContent = result.data.total_with_vat_formatted;

                const cartTitle = document.querySelector('.cart-header-title');
                if (cartTitle) {
                    cartTitle.textContent = `Cart - ${result.data.total_items} items`;
                }

                if (typeof loadMiniCart === 'function') {
                    loadMiniCart();
                }

                showToast('Removed item from the cart!');
            } else {
                showToast(result.message || 'Removed item failure', 'danger');
            }
        } catch (error) {
            showToast('Can not connect to server', 'danger');
        }
    });
}

const setupRemoveButtons = () => {
    const removeButtons = document.querySelectorAll('.remove-item');

    removeButtons.forEach(button => {
        button.addEventListener('click', (e) => {
            e.preventDefault();
            const productId = button.dataset.id;
            removeCartItem(productId);
        });
    });
};

const setupMiniCartOnOffcanvasShow = () => {
    const offcanvas = document.getElementById('offcanvasCart');
    if (!offcanvas) return;

    offcanvas.addEventListener('show.bs.offcanvas', function () {
        loadMiniCart();
    });
}

const setupQuantityButtons = () => {
    const buttons = document.querySelectorAll('.update-quantity');

    buttons.forEach(button => {
        button.addEventListener('click', async function (e) {
            e.preventDefault();

            const productId = this.dataset.id;
            const type = this.dataset.type;
            const input = document.querySelector(`.quantity-input[data-id="${productId}"]`);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            let quantity = parseInt(input.value);

            if (type === 'increase') {
                quantity++;
            } else if (type === 'decrease') {
                if (quantity <= 1) {
                    removeCartItem(productId);
                    return;
                }
                quantity--;
            }

            try {
                const response = await fetch('/cart/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity
                    })
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    input.value = result.data.quantity;

                    const lineTotalElem = input.closest('.row')?.querySelector('.line-total');
                    if (lineTotalElem) {
                        lineTotalElem.textContent = result.data.line_total_formatted;
                    }

                    document.querySelector('.summary-subtotal').textContent = result.data.subtotal_formatted;
                    document.querySelector('.cart-vat').textContent = result.data.vat_formatted;
                    document.querySelector('.cart-total-vat').textContent = result.data.total_with_vat_formatted;

                    const cartTitle = document.querySelector('.cart-header-title');
                    if (cartTitle) {
                        cartTitle.textContent = `Cart - ${result.data.total_items} items`;
                    }

                    if (typeof loadMiniCart === 'function') {
                        loadMiniCart();
                    }
                } else {
                    alert(result.message || 'Update failed!');
                }
            } catch (error) {
                alert('Error connecting to server.');
            }
        });
    });
};

async function loadMiniCart() {
    const loading = document.getElementById('mini-cart-loading');
    const itemsContainer = document.getElementById('mini-cart-items');
    const totalContainer = document.getElementById('mini-cart-total');

    loading.classList.remove('d-none');
    itemsContainer.innerHTML = '';
    totalContainer.innerHTML = '';

    try {
        const res = await fetch('/cart/mini');
        const data = await res.json();
        console.log(data);
        if (data.items.length > 0) {
            data.items.forEach(item => {
                const li = document.createElement('li');
                li.className = 'list-group-item d-flex justify-content-between lh-sm';
                li.innerHTML = `
                    <div>
                        <h6 class="my-0">${item.name}</h6>
                        <small class="text-muted">x${item.quantity}</small>
                    </div>
                    <span class="text-muted">${(item.subtotal).toLocaleString()}₫</span>
                `;
                itemsContainer.appendChild(li);
            });

            totalContainer.innerHTML = `
                <span>Temporary</span>
                <strong>${(data.total).toLocaleString()}₫</strong>
            `;
        } else {
            itemsContainer.innerHTML = `
                <li class="list-group-item text-center text-muted">
                    Your cart is empty!
                </li>
            `;
        }
    } catch (error) {
        console.error('Failed to load mini cart:', error);
        itemsContainer.innerHTML = `
            <li class="list-group-item text-danger">Lỗi tải giỏ hàng</li>
        `;
    } finally {
        loading.classList.add('d-none');
    }
};

const showConfirm = (message, callback) => {
    const modal = document.getElementById('custom-confirm');
    const messageElem = document.getElementById('confirm-message');
    const okButton = document.getElementById('confirm-ok-btn');

    messageElem.textContent = message;

    const newOkBtn = okButton.cloneNode(true);
    okButton.parentNode.replaceChild(newOkBtn, okButton);

    newOkBtn.addEventListener('click', () => {
        hideConfirm();
        callback(true);
    });

    modal.classList.add('show');
    modal.style.display = 'block';
    document.body.classList.add('modal-open');
    document.body.insertAdjacentHTML('beforeend', '<div class="modal-backdrop fade show"></div>');
}

const hideConfirm = () => {
    const modal = document.getElementById('custom-confirm');
    modal.classList.remove('show');
    modal.style.display = 'none';
    document.body.classList.remove('modal-open');
    const backdrop = document.querySelector('.modal-backdrop');
    if (backdrop) backdrop.remove();
};
