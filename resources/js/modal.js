document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('product-modal');
    const modalContent = document.getElementById('modal-content');
    const closeModal = document.getElementById('close-modal');

    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-product-id');
            fetch(`/products/${productId}`)
                .then(response => response.text())
                .then(html => {
                    modalContent.innerHTML = html;
                    modal.classList.remove('hidden');
                });
        });
    });

    closeModal.addEventListener('click', function () {
        modal.classList.add('hidden');
    });

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.classList.add('hidden');
        }
    });
});