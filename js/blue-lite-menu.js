/* Mobile Menu Toggle - Vanilla JS v1.0.0 */

document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const navMenu = document.querySelector('.nav-menu');
    const menuItems = document.querySelectorAll('.nav-menu li');

    // Main menu toggle
    if (menuToggle && navMenu) {
        menuToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            menuToggle.setAttribute('aria-expanded',
                menuToggle.getAttribute('aria-expanded') === 'true' ? 'false' : 'true'
            );
        });
    }

    // Sub-menu handling for mobile
    menuItems.forEach(item => {
        const submenu = item.querySelector('ul');
        if (submenu) {
            // Prevent hover/click behavior on mobile
            const link = item.querySelector('a');
            const originalUrl = link.getAttribute('href');

            // Create submenu toggle button
            const submenuToggle = document.createElement('button');
            submenuToggle.className = 'submenu-toggle';
            submenuToggle.innerHTML = '+';
            submenuToggle.setAttribute('aria-label', 'Toggle Submenu');

            // Insert toggle button after the link
            link.after(submenuToggle);

            // Handle submenu toggle click
            submenuToggle.addEventListener('click', (e) => {
                e.preventDefault();
                e.stopPropagation();
                item.classList.toggle('show-submenu');
                submenuToggle.innerHTML = item.classList.contains('show-submenu') ? '−' : '+';
                submenuToggle.setAttribute('aria-expanded',
                    item.classList.contains('show-submenu') ? 'true' : 'false'
                );
            });

            // Handle link click on mobile
            if (window.innerWidth <= 1200) {
                link.addEventListener('click', (e) => {
                    if (!item.classList.contains('show-submenu') && submenu) {
                        e.preventDefault();
                        item.classList.add('show-submenu');
                        submenuToggle.innerHTML = '−';
                        submenuToggle.setAttribute('aria-expanded', 'true');
                    }
                });
            }
        }
    });
});