function toggleDropdown(anchor) {
    const dropdown = anchor.nextElementSibling;
    const allDropdowns = document.querySelectorAll('.dropdown');

    // Close other open dropdowns
    allDropdowns.forEach(menu => {
        if (menu !== dropdown) {
            menu.classList.remove('show');
        }
    });

    // Toggle the clicked dropdown
    dropdown.classList.toggle('show');
}

// Close dropdown if clicked outside
window.addEventListener('click', function (e) {
    const allDropdowns = document.querySelectorAll('.dropdown');
    allDropdowns.forEach(menu => {
        if (!menu.contains(e.target) && menu.classList.contains('show')) {
            menu.classList.remove('show');
        }
    });
});