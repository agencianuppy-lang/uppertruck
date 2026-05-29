(function () {
    var motionReduced = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (window.AOS && typeof window.AOS.init === 'function') {
        window.AOS.init({
            once: true,
            offset: 40,
            duration: 680,
            easing: 'ease-out-cubic',
            disable: motionReduced
        });
    }

    if (window.lucide && typeof window.lucide.createIcons === 'function') {
        window.lucide.createIcons();
    }

    initFaq();
    initHeroParallax();
    initDedicatedTabs();
    initShowcaseSlider();
    initDashboardTabs();
    initCountUp();

    function initFaq() {
        var faqItems = document.querySelectorAll('.dedicated-faq-item');
        if (!faqItems.length) {
            return;
        }

        faqItems.forEach(function (item, index) {
            var summary = item.querySelector('summary');
            var answer = item.querySelector('.dedicated-faq-answer');

            if (!summary || !answer) {
                return;
            }

            var answerId = 'dedicated-faq-answer-' + index;
            answer.id = answerId;
            summary.setAttribute('aria-controls', answerId);

            function syncExpanded() {
                summary.setAttribute('aria-expanded', item.open ? 'true' : 'false');
            }

            syncExpanded();

            item.addEventListener('toggle', function () {
                syncExpanded();

                if (!item.open) {
                    return;
                }

                faqItems.forEach(function (other) {
                    if (other !== item) {
                        other.open = false;
                        var otherSummary = other.querySelector('summary');
                        if (otherSummary) {
                            otherSummary.setAttribute('aria-expanded', 'false');
                        }
                    }
                });
            });
        });
    }

    function initHeroParallax() {
        if (motionReduced) {
            return;
        }

        var visual = document.querySelector('.dedicated-hero-visual');
        var statusCard = document.querySelector('.dedicated-status-card');
        if (!visual || !statusCard) {
            return;
        }

        function onMove(event) {
            var rect = visual.getBoundingClientRect();
            var x = ((event.clientX - rect.left) / rect.width) - 0.5;
            var y = ((event.clientY - rect.top) / rect.height) - 0.5;

            statusCard.style.transform = 'translate3d(' + (x * 10).toFixed(2) + 'px,' + (y * 10).toFixed(2) + 'px,0)';
        }

        function onLeave() {
            statusCard.style.transform = 'translate3d(0,0,0)';
        }

        visual.addEventListener('mousemove', onMove);
        visual.addEventListener('mouseleave', onLeave);
    }

    function initDashboardTabs() {
        var buttons = Array.prototype.slice.call(document.querySelectorAll('[data-dashboard-tab]'));
        if (!buttons.length) {
            return;
        }

        var fields = {
            status: document.querySelector('[data-dashboard-field="status"]'),
            vehicle: document.querySelector('[data-dashboard-field="vehicle"]'),
            window: document.querySelector('[data-dashboard-field="window"]'),
            sla: document.querySelector('[data-dashboard-field="sla"]'),
            occurrence: document.querySelector('[data-dashboard-field="occurrence"]'),
            nextUpdate: document.querySelector('[data-dashboard-field="nextUpdate"]'),
            origin: document.querySelector('[data-dashboard-field="origin"]'),
            destination: document.querySelector('[data-dashboard-field="destination"]'),
            progressText: document.querySelector('[data-dashboard-field="progressText"]'),
            progressBar: document.querySelector('[data-dashboard-field="progressBar"]'),
            planningNote: document.querySelector('[data-dashboard-field="planningNote"]'),
            routeNote: document.querySelector('[data-dashboard-field="routeNote"]'),
            deliveryNote: document.querySelector('[data-dashboard-field="deliveryNote"]'),
            confirmNote: document.querySelector('[data-dashboard-field="confirmNote"]')
        };

        var scenarios = {
            planning: {
                status: 'Planejamento concluido',
                vehicle: 'Alocado',
                window: 'Dentro do previsto',
                sla: 'Monitorado',
                occurrence: 'Sem alerta critico',
                nextUpdate: '14:30',
                origin: 'Centro de Distribuicao',
                destination: 'Cliente estrategico',
                progressText: '18%',
                progressBar: '18%',
                planningNote: 'Rota validada, janela e contingencia definidas.',
                routeNote: 'Checklist de partida e tempo de rota confirmados.',
                deliveryNote: 'Entrega projetada dentro da agenda do cliente.',
                confirmNote: 'SLA base aprovado para inicio da execucao.'
            },
            route: {
                status: 'Em andamento',
                vehicle: 'Em rota dedicada',
                window: 'Dentro do previsto',
                sla: 'Monitorado em tempo real',
                occurrence: 'Sem alerta critico',
                nextUpdate: '15:10',
                origin: 'Centro de Distribuicao',
                destination: 'Cliente estrategico',
                progressText: '68%',
                progressBar: '68%',
                planningNote: 'Plano segue ativo com checkpoints cumpridos.',
                routeNote: 'Operacao com visibilidade de rota e marcos de status.',
                deliveryNote: 'Entrega confirmada para janela acordada.',
                confirmNote: 'Equipe preparada para tratativa imediata de ocorrencia.'
            },
            delivery: {
                status: 'Entrega finalizada',
                vehicle: 'Disponivel para proxima janela',
                window: 'Concluida no prazo',
                sla: 'SLA cumprido',
                occurrence: 'Sem ocorrencia relevante',
                nextUpdate: '16:40',
                origin: 'Centro de Distribuicao',
                destination: 'Cliente estrategico',
                progressText: '100%',
                progressBar: '100%',
                planningNote: 'Ciclo concluido e pronto para proxima programacao.',
                routeNote: 'Jornada executada com controle de marcos operacionais.',
                deliveryNote: 'Comprovacao de entrega registrada.',
                confirmNote: 'Leitura de performance enviada para melhoria continua.'
            }
        };

        function renderScenario(key) {
            var state = scenarios[key];
            if (!state) {
                return;
            }

            Object.keys(state).forEach(function (fieldName) {
                if (!fields[fieldName]) {
                    return;
                }

                if (fieldName === 'progressBar') {
                    fields[fieldName].style.width = state[fieldName];
                    return;
                }

                fields[fieldName].textContent = state[fieldName];
            });

            buttons.forEach(function (button) {
                var active = button.getAttribute('data-dashboard-tab') === key;
                button.classList.toggle('is-active', active);
                button.setAttribute('aria-selected', active ? 'true' : 'false');
            });
        }

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                renderScenario(button.getAttribute('data-dashboard-tab'));
            });
        });

        renderScenario('planning');
    }

    function initShowcaseSlider() {
        var medias = Array.prototype.slice.call(document.querySelectorAll('[data-showcase-media]'));
        var contents = Array.prototype.slice.call(document.querySelectorAll('[data-showcase-content]'));
        var counter = document.querySelector('[data-showcase-counter]');
        var prev = document.querySelector('[data-showcase-prev]');
        var next = document.querySelector('[data-showcase-next]');

        if (!medias.length || !contents.length || !prev || !next || medias.length !== contents.length) {
            return;
        }

        var index = 0;
        var total = medias.length;

        function render(activeIndex) {
            medias.forEach(function (media, mediaIndex) {
                var isActive = mediaIndex === activeIndex;
                media.classList.toggle('is-active', isActive);
                media.toggleAttribute('hidden', !isActive);
            });

            contents.forEach(function (content, contentIndex) {
                var isActive = contentIndex === activeIndex;
                content.classList.toggle('is-active', isActive);
                content.toggleAttribute('hidden', !isActive);
            });

            if (counter) {
                counter.textContent = String(activeIndex + 1) + '/' + String(total);
            }
        }

        function step(direction) {
            index = (index + direction + total) % total;
            render(index);
        }

        prev.addEventListener('click', function () {
            step(-1);
        });

        next.addEventListener('click', function () {
            step(1);
        });

        render(index);
    }

    function initDedicatedTabs() {
        var buttons = Array.prototype.slice.call(document.querySelectorAll('[data-dedicated-tab-button]'));
        var panels = Array.prototype.slice.call(document.querySelectorAll('[data-dedicated-tab-panel]'));
        if (!buttons.length || !panels.length) {
            return;
        }

        function setActiveTab(target) {
            buttons.forEach(function (button) {
                var active = button.getAttribute('data-dedicated-tab-button') === target;
                button.classList.toggle('is-active', active);
                button.setAttribute('aria-selected', active ? 'true' : 'false');
            });

            panels.forEach(function (panel) {
                var active = panel.getAttribute('data-dedicated-tab-panel') === target;
                panel.classList.toggle('is-active', active);
                panel.toggleAttribute('hidden', !active);
            });
        }

        buttons.forEach(function (button) {
            button.addEventListener('click', function () {
                setActiveTab(button.getAttribute('data-dedicated-tab-button'));
            });
        });
    }

    function initCountUp() {
        var counters = Array.prototype.slice.call(document.querySelectorAll('[data-count-target]'));
        if (!counters.length) {
            return;
        }

        var observer = new IntersectionObserver(function (entries, currentObserver) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) {
                    return;
                }

                animateCounter(entry.target);
                currentObserver.unobserve(entry.target);
            });
        }, { threshold: 0.45 });

        counters.forEach(function (counter) {
            observer.observe(counter);
        });
    }

    function animateCounter(node) {
        var target = Number(node.getAttribute('data-count-target')) || 0;
        var duration = motionReduced ? 0 : 1300;

        if (duration === 0) {
            node.textContent = String(target);
            return;
        }

        var start = 0;
        var startTime = null;

        function step(timestamp) {
            if (!startTime) {
                startTime = timestamp;
            }

            var elapsed = timestamp - startTime;
            var progress = Math.min(elapsed / duration, 1);
            var eased = 1 - Math.pow(1 - progress, 3);
            var value = Math.round(start + ((target - start) * eased));

            node.textContent = String(value);

            if (progress < 1) {
                window.requestAnimationFrame(step);
            } else {
                node.textContent = String(target);
            }
        }

        window.requestAnimationFrame(step);
    }
})();
