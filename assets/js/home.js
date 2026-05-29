(function () {
    var header = document.querySelector('[data-header]');
    var menuToggle = document.querySelector('[data-menu-toggle]');
    var mobileMenu = document.querySelector('[data-mobile-menu]');
    var mobileSubmenus = document.querySelectorAll('[data-mobile-submenu]');
    var revealElements = document.querySelectorAll('.reveal');
    var countupElements = document.querySelectorAll('[data-countup]');
    var heroPanel = document.querySelector('.hero-panel');
    var motionReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var headerIsScrolled = null;
    var headerTicking = false;

    function setHeaderState() {
        if (!header) {
            return;
        }

        var shouldBeScrolled = window.scrollY > 10;
        if (headerIsScrolled === shouldBeScrolled) {
            return;
        }

        headerIsScrolled = shouldBeScrolled;
        header.classList.toggle('is-scrolled', shouldBeScrolled);
    }

    function onHeaderScroll() {
        if (headerTicking) {
            return;
        }

        headerTicking = true;
        window.requestAnimationFrame(function () {
            setHeaderState();
            headerTicking = false;
        });
    }

    function closeMobileMenu() {
        if (!menuToggle || !mobileMenu) {
            return;
        }

        menuToggle.classList.remove('is-active');
        menuToggle.setAttribute('aria-expanded', 'false');
        mobileMenu.classList.remove('is-open');
    }

    function bindMobileMenu() {
        if (!menuToggle || !mobileMenu) {
            return;
        }

        menuToggle.addEventListener('click', function () {
            var isOpen = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', String(!isOpen));
            menuToggle.classList.toggle('is-active', !isOpen);
            mobileMenu.classList.toggle('is-open', !isOpen);
        });

        mobileMenu.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', closeMobileMenu);
        });

        window.addEventListener('resize', function () {
            if (window.innerWidth > 980) {
                closeMobileMenu();
            }
        });
    }

    function bindSubmenus() {
        mobileSubmenus.forEach(function (button) {
            button.addEventListener('click', function () {
                var expanded = button.getAttribute('aria-expanded') === 'true';
                var panel = button.nextElementSibling;

                button.setAttribute('aria-expanded', String(!expanded));
                if (panel) {
                    panel.hidden = expanded;
                }
            });
        });
    }

    function formatCount(value, decimals, prefix, suffix) {
        return prefix + value.toFixed(decimals) + suffix;
    }

    function runCountup(element) {
        if (!element || element.dataset.animated === 'true') {
            return;
        }

        var target = Number(element.dataset.target || 0);
        var decimals = Number(element.dataset.decimals || 0);
        var prefix = element.dataset.prefix || '';
        var suffix = element.dataset.suffix || '';
        var duration = 1100;
        var start = performance.now();

        element.dataset.animated = 'true';

        function tick(now) {
            var elapsed = now - start;
            var progress = Math.min(elapsed / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var current = target * eased;
            element.textContent = formatCount(current, decimals, prefix, suffix);

            if (progress < 1) {
                requestAnimationFrame(tick);
            }
        }

        requestAnimationFrame(tick);
    }

    function bindRevealAndCountup() {
        if (!('IntersectionObserver' in window)) {
            revealElements.forEach(function (element) {
                element.classList.add('is-visible');
            });
            countupElements.forEach(runCountup);
            return;
        }

        var observer = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) {
                    return;
                }

                entry.target.classList.add('is-visible');
                if (entry.target.matches('[data-countup]')) {
                    runCountup(entry.target);
                }

                obs.unobserve(entry.target);
            });
        }, {
            threshold: 0.18,
            rootMargin: '0px 0px -40px 0px'
        });

        revealElements.forEach(function (element) {
            observer.observe(element);
        });

        countupElements.forEach(function (element) {
            observer.observe(element);
        });
    }

    function bindHeroParallax() {
        if (!heroPanel || motionReduced) {
            return;
        }

        var frame = heroPanel.closest('.hero-frame');
        if (!frame) {
            return;
        }

        frame.addEventListener('mousemove', function (event) {
            var rect = frame.getBoundingClientRect();
            var x = (event.clientX - rect.left) / rect.width - 0.5;
            var y = (event.clientY - rect.top) / rect.height - 0.5;

            heroPanel.style.transform = 'translate3d(' + (x * 8).toFixed(2) + 'px,' + (y * 8).toFixed(2) + 'px,0)';
        });

        frame.addEventListener('mouseleave', function () {
            heroPanel.style.transform = 'translate3d(0,0,0)';
        });
    }

    function bindSegmentHub() {
        var hub = document.querySelector('[data-segment-hub]');
        if (!hub) {
            return;
        }

        var items = hub.querySelectorAll('.segment-nav-item');
        var triggers = hub.querySelectorAll('.segment-nav-trigger');
        var mediaImage = hub.querySelector('[data-segment-media-image]');
        var mediaCaptionText = hub.querySelector('[data-segment-media-caption]');
        var label = hub.querySelector('[data-segment-output-label]');
        var number = hub.querySelector('[data-segment-output-number]');
        var copy = hub.querySelector('[data-segment-output-copy]');
        var link = hub.querySelector('[data-segment-output-link]');
        var linkLabel = hub.querySelector('[data-segment-output-link-label]');
        var progressDuration = 3600;
        var switchTimer;
        var autoTimer;

        if (!triggers.length || !mediaImage || !mediaCaptionText || !label || !number || !copy || !link || !linkLabel) {
            return;
        }

        hub.style.setProperty('--segment-progress-duration', progressDuration + 'ms');

        function restartProgress(item) {
            items.forEach(function (li) {
                li.classList.remove('is-progressing');
            });
            void item.offsetWidth;
            item.classList.add('is-progressing');
        }

        function scheduleNext(currentIndex) {
            window.clearTimeout(autoTimer);
            autoTimer = window.setTimeout(function () {
                var nextIndex = (currentIndex + 1) % triggers.length;
                setActive(triggers[nextIndex], true);
            }, progressDuration);
        }

        function setActive(trigger, forceRestart) {
            var item = trigger.closest('.segment-nav-item');
            if (!item) {
                return;
            }

            var alreadyActive = item.classList.contains('is-active');
            if (alreadyActive && !forceRestart) {
                return;
            }

            items.forEach(function (li) {
                li.classList.remove('is-active');
            });
            item.classList.add('is-active');
            restartProgress(item);

            hub.classList.add('is-switching');
            window.clearTimeout(switchTimer);

            switchTimer = window.setTimeout(function () {
                mediaImage.src = trigger.dataset.segmentImage || mediaImage.src;
                mediaImage.alt = trigger.dataset.segmentAlt || mediaImage.alt;
                mediaCaptionText.textContent = trigger.dataset.segmentCaption || mediaCaptionText.textContent;
                label.textContent = trigger.dataset.segmentLabel || label.textContent;
                number.textContent = trigger.dataset.segmentNumber || number.textContent;
                copy.textContent = trigger.dataset.segmentCopy || copy.textContent;
                link.href = trigger.dataset.segmentLinkHref || link.href;
                linkLabel.textContent = trigger.dataset.segmentLinkLabel || linkLabel.textContent;

                hub.classList.remove('is-switching');
            }, 85);

            scheduleNext(Array.prototype.indexOf.call(triggers, trigger));
        }

        triggers.forEach(function (trigger) {
            trigger.addEventListener('mouseenter', function () {
                setActive(trigger, true);
            });

            trigger.addEventListener('focus', function () {
                setActive(trigger, true);
            });

            trigger.addEventListener('click', function () {
                setActive(trigger, true);
            });
        });

        var initialTrigger = hub.querySelector('.segment-nav-item.is-active .segment-nav-trigger') || triggers[0];
        if (initialTrigger) {
            setActive(initialTrigger, true);
        }
    }

    setHeaderState();
    bindMobileMenu();
    bindSubmenus();
    bindRevealAndCountup();
    bindHeroParallax();
    bindSegmentHub();

    window.addEventListener('scroll', onHeaderScroll, { passive: true });

    if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
    }
})();
