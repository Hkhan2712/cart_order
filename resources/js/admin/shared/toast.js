export const showToast = (message, type = 'primary') => {
    const toastEl = document.getElementById('liveToast');
    const toastBody = document.getElementById('toast-message');

    toastBody.textContent = message;
    toastEl.className = `toast align-items-center text-bg-${type} border-0 slide-toast`;

    const toastBootstrap = new bootstrap.Toast(toastEl, { delay: 3000 });
    toastBootstrap.show();
};