document.addEventListener('DOMContentLoaded', function () {

    // =============== Búsqueda ===============
    if (elementExists('search-icon')) {
        const searchIcon = document.getElementById('search-icon');
        const searchForm = document.getElementById('search-form');
        const searchInput = document.getElementById('search-input');

        searchIcon.addEventListener('click', function (event) {
            event.preventDefault();
            showSearch();
        });

        searchInput.addEventListener('keydown', function (event) {
            if (event.key === 'Enter') {
                searchForm.submit();
            }
        });

        searchInput.addEventListener('blur', function () {
            hideSearch();
        });

        function showSearch() {
            searchForm.style.opacity = '1';
            searchForm.style.width = '300px';
            searchInput.focus();
        }

        function hideSearch() {
            searchForm.style.opacity = '0';
            searchForm.style.width = '0';
            setTimeout(() => {
                searchInput.value = '';
            }, 300);
        }
    }

    // =============== Contador de cantidad ===============
    if (elementExists('quantity-display')) {
        const increaseBtn = document.getElementById('increase-quantity');
        const decreaseBtn = document.getElementById('decrease-quantity');
        const display = document.getElementById('quantity-display');

        let quantity = parseInt(display.textContent, 10) || 0;

        increaseBtn.addEventListener('click', () => {
            quantity++;
            updateDisplay();
        });

        decreaseBtn.addEventListener('click', () => {
            if (quantity > 1) {
                quantity--;
                updateDisplay();
            }
        });

        function updateDisplay() {
            display.textContent = quantity;
        }

        const radios = document.querySelectorAll('input[name="size"]');
        const addToCartBtn = document.getElementById('addToCartBtn');

        function validateSelection() {
            const selected = document.querySelector('input[name="size"]:checked');
            addToCartBtn.disabled = !selected;
        }

        radios.forEach(radio => {
            radio.addEventListener('change', validateSelection);
        });

        validateSelection();
    }

    // =============== Carrito de compras ===============
    if (elementExists('cart-sidebar')) {
        const cartIcon = document.getElementById('cart-icon');
        const cartSidebar = document.getElementById('cart-sidebar');
        const cartOverlay = document.getElementById('cart-overlay');
        const cartCount = document.getElementById('cart-count');
        const cartCounter = document.getElementById('cart-counter');
        const cartItemsContainer = document.getElementById('cart-items-container');
        const cartTotalElement = document.getElementById('cart-total');

        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        function updateCartUI() {
            cartItemsContainer.innerHTML = '';
            let total = 0;

            if (cart.length === 0) {
                cartItemsContainer.innerHTML = '<p>No hay productos en el carrito.</p>';
                cartTotalElement.textContent = '0';
            } else {
                cart.forEach((item) => {
                    const itemTotal = item.price * item.quantity;
                    total += itemTotal;

                    const itemDiv = document.createElement('div');
                    itemDiv.className = 'cart-item';
                    itemDiv.innerHTML = `
                    <img src="/img/catalog/${item.image}" alt="${item.name}">
                    <div class="cart-item-info">
                        <p>${item.name}</p>
                        <p>Talla: ${item.size || 'N/A'}</p>
                        <p>x ${item.quantity}</p>
                        <p>$ ${formatNumber(itemTotal)}</p>
                    </div>
                    <button class="remove-from-cart" data-id="${item.id}" data-size="${item.size}">
                        <img src="/img/delete-icon.png" alt="Eliminar" width="18">
                    </button>
                `;

                    // Asignar evento al botón recién creado
                    const btn = itemDiv.querySelector('.remove-from-cart');
                    btn.addEventListener('click', function () {
                        console.log("Borrar");
                        const id = parseInt(this.getAttribute('data-id'));
                        const size = this.getAttribute('data-size');
                        removeFromCart(id, size);
                    });

                    cartItemsContainer.appendChild(itemDiv);
                });

                cartTotalElement.textContent = formatNumber(total);
            }

            cartCount.textContent = cart.length;
            cartCounter.textContent = cartCount.textContent;
        }

        function formatNumber(numero) {
            if (typeof numero !== 'number' && typeof numero !== 'string') return '0';
            let num = typeof numero === 'string' ? parseFloat(numero) : numero;
            if (isNaN(num)) return '0';
            return num.toLocaleString('es-ES');
        }

        cartIcon.addEventListener('click', function (event) {
            event.preventDefault();
            cartSidebar.classList.add('active');
            cartOverlay.style.display = 'block';
            updateCartUI();
        });

        cartOverlay.addEventListener('click', function () {
            cartSidebar.classList.remove('active');
            cartOverlay.style.display = 'none';
        });

        window.addToCart = function (productData) {
            const existingItem = cart.find(item =>
                item.id === productData.id && item.size === productData.size);

            if (!existingItem) {
                cart.push(productData);
                localStorage.setItem('cart', JSON.stringify(cart));
                updateCartUI();
            } else {
                alert('Este producto ya está en el carrito.');
            }
        };

        window.removeFromCart = function (productId, size) {
            cart = cart.filter(item => !(item.id === productId && item.size === size));
            localStorage.setItem('cart', JSON.stringify(cart));
            updateCartUI();
        }


        const finalizeOrderBtn = document.getElementById('finalizeOrderBtn');
        const loadingModal = document.getElementById('loadingModal');
        const confirmationModal = document.getElementById('confirmationModal');
        const closeModalBtn = document.getElementById('closeModalBtn');
        const orderIdText = document.getElementById('orderIdText');

        if (finalizeOrderBtn) {
            finalizeOrderBtn.addEventListener('click', function () {
                const cart = JSON.parse(localStorage.getItem('cart')) || [];

                if (cart.length === 0) {
                    alert('El carrito está vacío.');
                    return;
                }

                loadingModal.style.display = 'flex';

                const orderData = {
                    items: cart.map(item => ({
                        product_id: item.id,
                        size: item.size,
                        quantity: item.quantity,
                        price: item.price
                    }))
                };

                fetch('/order', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify(orderData)
                })
                    .then(response => response.json())
                    .then(data => {
                        loadingModal.style.display = 'none';

                        if (data.success && data.orderId) {
                            localStorage.removeItem('cart');
                            updateCartUI();

                            orderIdText.textContent = data.orderId;

                            confirmationModal.style.display = 'flex';
                        } else {
                            alert('Hubo un error al procesar el pedido.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        loadingModal.style.display = 'none';
                        alert('No se pudo conectar con el servidor.');
                    });
            });
        }


        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', function () {
                confirmationModal.style.display = 'none';
                location.reload();
            });
        }

        updateCartUI();
    }

    // =============== Filtros ===============
    if (elementExists('open-filter-btn')) {
        const openBtn = document.getElementById('open-filter-btn');
        const overlay = document.getElementById('filter-overlay');
        const sidebar = document.getElementById('filter-sidebar');

        openBtn.addEventListener('click', () => {
            sidebar.classList.add('active');
            overlay.style.display = 'block';
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.remove('active');
            overlay.style.display = 'none';
        });
    }

    // =============== Resetear filtros ===============
    window.resetFilters = function () {
        const form = document.getElementById('filter-form');
        if (form) {
            form.reset();

            const checkboxes = form.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(cb => cb.checked = false);
        }
    };

});

function elementExists(id) {
    return document.getElementById(id) !== null;
}
