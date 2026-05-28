document.addEventListener('DOMContentLoaded', function() {

    // Initialize AOS with optimized settings for faster performance
    AOS.init({
        duration: 600,           // Reduced from 1000ms to 600ms
        easing: 'ease-out-cubic',
        once: true,
        offset: 50,             // Reduced from 100 to 50 for earlier trigger
        mirror: false,
        anchorPlacement: 'top-bottom',
        disable: window.innerWidth < 768  // Disable on mobile for better performance
    });

    // ERP Submenu Toggle Functionality
    const erpToggle = document.querySelector('.erp-toggle');
    const erpSubmenu = document.querySelector('.submenu');

    if (erpToggle && erpSubmenu) {
        // Show submenu on hover
        erpToggle.parentElement.addEventListener('mouseenter', function() {
            erpSubmenu.style.opacity = '1';
            erpSubmenu.style.visibility = 'visible';
            erpSubmenu.style.transform = 'translateX(0)';
        });

        // Hide submenu on mouse leave
        erpToggle.parentElement.addEventListener('mouseleave', function() {
            erpSubmenu.style.opacity = '0';
            erpSubmenu.style.visibility = 'hidden';
            erpSubmenu.style.transform = 'translateX(10px)';
        });

        // Mobile click functionality
        if (window.innerWidth <= 991) {
            erpToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const isVisible = erpSubmenu.style.opacity === '1';
                if (isVisible) {
                    erpSubmenu.style.opacity = '0';
                    erpSubmenu.style.visibility = 'hidden';
                    erpSubmenu.style.transform = 'translateX(10px)';
                } else {
                    erpSubmenu.style.opacity = '1';
                    erpSubmenu.style.visibility = 'visible';
                    erpSubmenu.style.transform = 'translateX(0)';
                }
            });
        }
    }

    // Smooth scroll for entire page
    document.documentElement.style.scrollBehavior = 'smooth';

    // Enhanced smooth scroll for all elements
    const enableSmoothScroll = function() {
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                if (this.getAttribute('href')) {
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start',
                            inline: 'nearest'
                        });
                    }
                }
            });
        });

        // Smooth scroll for navigation clicks
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', function (e) {
                if (this.getAttribute('href').startsWith('#')) {
                    e.preventDefault();
                    const targetId = this.getAttribute('href').substring(1);
                    const targetElement = document.getElementById(targetId);
                    if (targetElement) {
                        targetElement.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start',
                            inline: 'nearest'
                        });
                    }
                }
            });
        });

        // Handle dropdown submenus
        const dropdownSubmenus = document.querySelectorAll('.dropdown-submenu');

        dropdownSubmenus.forEach(submenu => {
            const toggle = submenu.querySelector('.dropdown-toggle');
            const menu = submenu.querySelector('.submenu');

            // Handle ERP submenu
            if (toggle && toggle.classList.contains('erp-toggle')) {
                // Desktop: hover opens submenu, click navigates
                if (window.innerWidth > 991) {
                    submenu.addEventListener('mouseenter', function() {
                        menu.classList.add('show');
                        toggle.classList.add('show');
                        menu.style.display = 'block';
                        menu.style.opacity = '1';
                        menu.style.visibility = 'visible';
                        menu.style.transform = 'translateX(0)';
                        const chevron = toggle.querySelector('.fa-chevron-right');
                        if (chevron) chevron.classList.add('rotated');
                    });
                    submenu.addEventListener('mouseleave', function() {
                        menu.classList.remove('show');
                        toggle.classList.remove('show');
                        menu.style.display = 'none';
                        menu.style.opacity = '0';
                        menu.style.visibility = 'hidden';
                        menu.style.transform = 'translateX(-10px)';
                        const chevron = toggle.querySelector('.fa-chevron-right');
                        if (chevron) chevron.classList.remove('rotated');
                    });
                    // Click navigates to ERPNext page
                    toggle.addEventListener('click', function(e) {
                        // Allow default navigation
                    });
                } else {
                    // Mobile: click toggles submenu
                    toggle.addEventListener('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        const chevron = toggle.querySelector('.fa-chevron-right');
                        if (menu.classList.contains('show')) {
                            menu.classList.remove('show');
                            toggle.classList.remove('show');
                            menu.style.display = 'none';
                            menu.style.opacity = '0';
                            menu.style.visibility = 'hidden';
                            menu.style.transform = 'translateX(-10px)';
                            if (chevron) chevron.classList.remove('rotated');
                        } else {
                            menu.classList.add('show');
                            toggle.classList.add('show');
                            menu.style.display = 'block';
                            menu.style.opacity = '1';
                            menu.style.visibility = 'visible';
                            menu.style.transform = 'translateX(0)';
                            if (chevron) chevron.classList.add('rotated');
                        }
                    });
                }
            } else {
                // Handle hover for other submenus
                submenu.addEventListener('mouseenter', function() {
                    menu.style.display = 'block';
                    menu.style.opacity = '1';
                    menu.style.visibility = 'visible';
                    menu.style.transform = 'translateY(0)';
                });

                // Hide submenu on mouse leave
                submenu.addEventListener('mouseleave', function() {
                    setTimeout(function() {
                        menu.style.display = 'none';
                        menu.style.opacity = '0';
                        menu.style.visibility = 'hidden';
                        menu.style.transform = 'translateX(-10px)';
                    }, 200);
                });
            }
        });

        // Close submenus when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.dropdown-submenu')) {
                document.querySelectorAll('.submenu').forEach(function(menu) {
                    menu.style.display = 'none';
                    menu.style.opacity = '0';
                    menu.style.visibility = 'hidden';
                    menu.style.transform = 'translateX(-10px)';
                });
            }
        });
    };

    // Initialize smooth scroll
    enableSmoothScroll();

    // Navbar Scroll Effect
    const navbar = document.querySelector('.navbar-glass');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }

    // Counter animation for impact numbers
    const animateCounter = function(element, target) {
        let current = 0;
        const increment = target / 100;
        const timer = setInterval(function() {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current) + (element.textContent.includes('+') ? '+' : '');
        }, 20);
    };

    // Trigger counter animations when in viewport
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };

    const counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const text = counter.textContent;
                const number = parseInt(text.replace(/\D/g, ''));
                const suffix = text.includes('+') ? '+' : '';

                animateCounter(counter, number);
                counterObserver.unobserve(counter);
            }
        });
    }, observerOptions);

    // Observe all impact numbers
    document.querySelectorAll('.impact-number .display-4').forEach(function(counter) {
        counterObserver.observe(counter);
    });
});
