document.addEventListener('DOMContentLoaded', function () {
    setupAddToCartButtons();
    setupMiniCartOnOffcanvasShow();
    setupQuantityButtons();
});

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
                    alert('Added to cart!');
                    loadMiniCart();
                } else {
                    alert(result.message || 'Failure add to cart!');
                }
            } catch (err) {
                console.error(err);
                alert('Error connected with server.');
            }
        });
    });
}


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
            } else if (type === 'decrease' && quantity > 1) {
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

                    const subtotalElem = document.querySelector('.summary-subtotal');
                    const vatElem = document.querySelector('.cart-vat');
                    const totalElem = document.querySelector('.cart-total-vat');

                    if (subtotalElem) {
                        subtotalElem.textContent = result.data.subtotal_formatted;
                    }
                    if (vatElem) {
                        vatElem.textContent = result.data.vat_formatted;
                    }
                    if (totalElem) {
                        totalElem.textContent = result.data.total_with_vat_formatted;
                    }

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
}