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

    const headlineToggle = document.querySelector('.btn-toggle-headline-view');
    if (headlineToggle) {
        const storageKey = 'uflp-headline-view';

        const setHeadlineView = function(active) {
            document.body.classList.toggle('is-headline-view-active', active);
            headlineToggle.setAttribute('aria-pressed', active ? 'true' : 'false');
            try {
                sessionStorage.setItem(storageKey, active ? '1' : '0');
            } catch (error) {}
        };

        try {
            if (sessionStorage.getItem(storageKey) === '1') {
                setHeadlineView(true);
            }
        } catch (error) {}

        headlineToggle.addEventListener('click', function() {
            setHeadlineView(!document.body.classList.contains('is-headline-view-active'));
        });
    }

    const mobilityForm = document.getElementById('mobility-calculator');
    if (mobilityForm) {
        const MIN_HOURS = 30;
        const FULL_TIME_HOURS = 38.5;
        const hoursInput = mobilityForm.querySelector('#mobility-hours');
        const result = mobilityForm.querySelector('.mobility-calculator-result');
        const euro = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' });

        const parseHours = function(value) {
            const normalized = String(value).trim().replace(',', '.');
            if (normalized === '') {
                return null;
            }
            const hours = Number(normalized);
            if (!Number.isFinite(hours) || hours < 0) {
                return null;
            }
            return hours;
        };

        const roundCents = function(amount) {
            return Math.round((amount + Number.EPSILON) * 100) / 100;
        };

        const allowanceAmount = function(input, hours) {
            const fullAmount = Number(input.dataset.amount);
            if (input.dataset.prorate !== '1') {
                return fullAmount;
            }
            const countedHours = Math.min(hours, FULL_TIME_HOURS);
            return roundCents(fullAmount * countedHours / FULL_TIME_HOURS);
        };

        const selectedAllowances = function() {
            return Array.from(mobilityForm.querySelectorAll('input[data-amount]')).filter(function(input) {
                return input.checked;
            });
        };

        const render = function() {
            const hours = parseHours(hoursInput.value);
            if (hours === null) {
                result.innerHTML = '<p>Bitte die Wochenstunden eintragen.</p>';
                return;
            }
            if (hours < MIN_HOURS || hours > FULL_TIME_HOURS) {
                result.innerHTML = '<p>Bitte eine Stundenzahl zwischen 30 und 38,5 eintragen.</p>';
                return;
            }

            const items = selectedAllowances();
            if (!items.length) {
                result.innerHTML = '<p>Keine Zulage ausgewählt.</p>';
                return;
            }

            let total = 0;
            const rows = items.map(function(input) {
                const amount = allowanceAmount(input, hours);
                total += amount;
                return '<li><span>' + input.dataset.label + '</span><span>' + euro.format(amount) + '</span></li>';
            }).join('');

            result.innerHTML = '<ul>' + rows + '</ul><p class="mobility-calculator-total"><span>Summe</span><span>' + euro.format(roundCents(total)) + '</span></p>';
        };

        mobilityForm.addEventListener('submit', function(event) {
            event.preventDefault();
            render();
        });
    }
});
