document.addEventListener('DOMContentLoaded', function () {
    fetch('/user-address', {
        headers: {
            'Accept': 'application/json'
        },
        credentials: 'same-origin'
    })
    .then(response => response.json())
    .then(data => {
        const addressList = document.getElementById('shipping-address-list');
        addressList.innerHTML = '';

        if (data.data.length === 0) {
            addressList.innerHTML = `<p class="text-muted">You don't have any address yet.</p>`;
            return;
        }

        data.data.forEach((address, index) => {
            const html = `
                <div class="col-lg-4 col-sm-6">
                    <label class="card-radio-label mb-0">
                        <input type="radio" name="address_id" class="card-radio-input" value="${address.id}" ${index === 0 ? 'checked' : ''}>
                        <div class="card-radio text-truncate p-3">
                            <span class="fs-14 mb-4 d-block">Address ${index + 1}</span>
                            <span class="fs-14 mb-2 d-block">${address.name ?? ''}</span>
                            <span class="text-muted fw-normal text-wrap d-block mb-1">${address.address}</span>
                            <span class="text-muted fw-normal d-block">Phone: ${address.phone ?? ''}</span>
                        </div>
                    </label>
                </div>
            `;
            addressList.insertAdjacentHTML('beforeend', html);
        });
    })
    .catch(error => {
        console.error('Error fetching addresses:', error);
    });
});