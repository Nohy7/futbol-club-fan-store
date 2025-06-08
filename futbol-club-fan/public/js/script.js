document.addEventListener('DOMContentLoaded', function () {
    const searchIcon = document.getElementById('search-icon');
    const searchForm = document.getElementById('search-form');
    const searchInput = document.getElementById('search-input');

    // Cuando se hace clic en el icono de búsqueda
    searchIcon.addEventListener('click', function (event) {
        event.preventDefault();
        showSearch();
    });

    // Cuando el usuario presiona Enter
    searchInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter') {
            searchForm.submit();
        }
    });

    // Cuando el input pierde el focus
    searchInput.addEventListener('blur', function () {
        hideSearch();
    });


    function showSearch() {
        searchForm.style.opacity = '1';
        searchForm.style.width = '300px';
        searchInput.focus();
    }

    // Función para ocultar el input
    function hideSearch() {
        searchForm.style.opacity = '0';
        searchForm.style.width = '0';
        setTimeout(() => {
            searchInput.value = '';
        }, 300);
    }
});


const openBtn = document.getElementById('open-filter-btn');
const overlay = document.getElementById('filter-overlay');
const sidebar = document.getElementById('filter-sidebar');

const closeBtn = document.getElementById('close-filter-btn');

openBtn.addEventListener('click', () => {
    sidebar.classList.add('active');
    overlay.style.display = 'block';
});

overlay.addEventListener('click', () => {
    sidebar.classList.remove('active');
    overlay.style.display = 'none';
});


function resetFilters() {
    const form = document.getElementById('filter-form');
    form.reset();

    // Desmarcar checkboxes
    const checkboxes = form.querySelectorAll('input[type="checkbox"]');
    checkboxes.forEach(cb => cb.checked = false);

    // Opcional: enviar automáticamente el formulario limpio
    // form.submit();
}
