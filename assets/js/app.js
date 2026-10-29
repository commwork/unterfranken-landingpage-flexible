document.addEventListener('DOMContentLoaded', function() {
    // const headerSection = document.querySelector('.header-section');
    // if (headerSection) {
    //     const scrollThreshold = 300;
    //     let ticking = false;

    //     const updateHeaderScrollState = function() {
    //         headerSection.classList.toggle('scrolled-down', window.scrollY >= scrollThreshold);
    //         ticking = false;
    //     };

    //     window.addEventListener('scroll', function() {
    //         if (!ticking) {
    //             requestAnimationFrame(updateHeaderScrollState);
    //             ticking = true;
    //         }
    //     }, { passive: true });

    //     updateHeaderScrollState();
    // }

    document.addEventListener('click', function(event) {
        const link = event.target.closest('a[href^="#"]');
        if (!link) {
            return;
        }

        const hash = link.getAttribute('href');
        if (!hash || hash === '#') {
            return;
        }

        const target = document.querySelector(hash);
        if (!target) {
            return;
        }

        event.preventDefault();

        const header = document.querySelector('.header-section');
        const headerOffset = header ? header.offsetHeight : 0;
        const top = target.getBoundingClientRect().top + window.scrollY - headerOffset - 16;
        const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

        window.scrollTo({
            top: Math.max(top, 0),
            behavior: prefersReducedMotion ? 'auto' : 'smooth'
        });

        history.pushState(null, '', hash);
    });

    document.addEventListener('click', function(event) {
        const trigger = event.target.closest('.accordion-item-title');
        if (!trigger) {
            return;
        }

        const item = trigger.closest('.accordion-item');
        if (!item) {
            return;
        }

        const isOpen = item.classList.toggle('is-open');
        trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });
});
