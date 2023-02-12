function toast({ title = '', message = '', type = 'info', duration = 3000 }) {
    const main = document.getElementById('toast')
    if (main) {
        const toast = document.createElement('div');
        const autoRemoveID = setTimeout(function () {
            main.removeChild(toast);
        }, duration + 1000);

        toast.onclick = function (e) {
            if (e.target.closest('.toast__close')) {
                main.removeChild(toast);
                clearTimeout(autoRemoveID);
            }
        }
        const icons = {
            success: 'bi bi-check-circle-fill',
            info: 'bi bi-info-circle-fill',
            warning: 'bi bi-exclamation-triangle',
            error: 'bi bi-exclamation-triangle',
        }
        const icon = icons[type];
        toast.classList.add('toast', `toast--${type}`);
        const delay = (duration / 1000).toFixed(2)
        toast.style.animation = `slideInLeft ease 2s, fadeOut linear 1s ${delay}s forwards`;
        toast.innerHTML = `
        <div class="toast__icon">
            <i class="${icon}"></i>
        </div>
        <div class="toast__body">
            <h2  class="toast__title">${title}</h2>
            <p class="toast__msg">${message}</p>
        </div>
        <div class="toast__close">
            <span class="bi bi-x-lg"></span>

        </div>
        `;
        main.appendChild(toast);

    }
}

function showSuccess() {
    toast({
        title: 'Success',
        message: 'Thành công',
        type: 'success',
        duration: 3000
    })
}
function showError() {
    toast({
        title: 'Error',
        message: 'Không thành công',
        type: 'error',
        duration: 3000
    })
}
function showInfo() {
    toast({
        title: 'Info',
        message: 'Bạn có chắc',
        type: 'info',
        duration: 3000
    })
}
function showWarning() {
    toast({
        title: 'Warning',
        message: 'Nguy hiểm',
        type: 'warning',
        duration: 3000
    })
}