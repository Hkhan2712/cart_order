document.addEventListener('DOMContentLoaded', function () {
    setupAddToCartButtons();
    setupMiniCartOnOffcanvasShow();
});

/**
 * Gán sự kiện click cho nút thêm sản phẩm vào giỏ
 */
const setupAddToCartButtons = () => {
    document.querySelectorAll('.btn-cart').forEach(button => {
        button.addEventListener('click', async function (e) {
            e.preventDefault();
            const productCard = this.closest('.product-item');
            const quantity = productCard.querySelector('input.quantity').value || 1;
            const productId = productCard.dataset.productId;

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
                    alert('Đã thêm vào giỏ!');
                    loadMiniCart(); 
                } else {
                    alert(result.message || 'Thêm không thành công.');
                }
            } catch (err) {
                console.error(err);
                alert('Lỗi kết nối máy chủ.');
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
                <span>Tổng</span>
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