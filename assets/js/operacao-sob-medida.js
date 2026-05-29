(function () {
    const buttons = Array.from(document.querySelectorAll('[data-osm-tab]'));
    if (!buttons.length) {
        return;
    }

    const title = document.getElementById('osm-tab-title');
    const text = document.getElementById('osm-tab-text');
    const progressValue = document.getElementById('osm-progress-value');
    const progressBar = document.getElementById('osm-progress-bar');
    const route = document.getElementById('osm-route');
    const frequency = document.getElementById('osm-frequency');
    const critical = document.getElementById('osm-critical');
    const contingency = document.getElementById('osm-contingency');
    const follow = document.getElementById('osm-follow');
    const metric1 = document.getElementById('osm-m1');
    const metric2 = document.getElementById('osm-m2');
    const metric3 = document.getElementById('osm-m3');
    const metric4 = document.getElementById('osm-m4');
    const metric5 = document.getElementById('osm-m5');
    const metric6 = document.getElementById('osm-m6');

    if (
        !title || !text || !progressValue || !progressBar || !route || !frequency ||
        !critical || !contingency || !follow || !metric1 || !metric2 ||
        !metric3 || !metric4 || !metric5 || !metric6
    ) {
        return;
    }

    const tabData = {
        'diagnostico': {
            title: 'Operacao em analise',
            text: 'Mapeamento de rotas, volumes, pontos criticos e prioridades.',
            progress: 30,
            route: 'Sob planejamento',
            frequency: 'Em definicao',
            critical: 'Mapeamento inicial',
            contingency: 'Em estudo',
            follow: 'Ativo',
            m1: '4',
            m2: '8',
            m3: '3',
            m4: 'Em acompanhamento',
            m5: '2',
            m6: '1'
        },
        'planejamento': {
            title: 'Modelo em desenho',
            text: 'Definicao de fluxo, recursos, janelas e acompanhamento.',
            progress: 65,
            route: 'Sequencia definida',
            frequency: 'Semanal',
            critical: 'Priorizados',
            contingency: 'Planejada',
            follow: 'Ativo',
            m1: '4',
            m2: '8',
            m3: '3',
            m4: 'Meta 97%',
            m5: '3',
            m6: '1'
        },
        'operacao': {
            title: 'Operacao acompanhada',
            text: 'Execucao com leitura de performance e ajustes continuos.',
            progress: 100,
            route: 'Em execucao',
            frequency: 'Definida',
            critical: 'Monitorados',
            contingency: 'Ativa',
            follow: 'Em tempo real',
            m1: '4',
            m2: '8',
            m3: '3',
            m4: 'SLA monitorado',
            m5: '2',
            m6: '1'
        }
    };

    const applyTab = (key) => {
        const data = tabData[key];
        if (!data) {
            return;
        }

        buttons.forEach((button) => {
            const isActive = button.getAttribute('data-osm-tab') === key;
            button.classList.toggle('is-active', isActive);
            button.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });

        title.textContent = data.title;
        text.textContent = data.text;
        progressValue.textContent = data.progress + '%';
        progressBar.style.width = data.progress + '%';
        route.textContent = data.route;
        frequency.textContent = data.frequency;
        critical.textContent = data.critical;
        contingency.textContent = data.contingency;
        follow.textContent = data.follow;
        metric1.textContent = data.m1;
        metric2.textContent = data.m2;
        metric3.textContent = data.m3;
        metric4.textContent = data.m4;
        metric5.textContent = data.m5;
        metric6.textContent = data.m6;
    };

    buttons.forEach((button) => {
        button.addEventListener('click', () => {
            applyTab(button.getAttribute('data-osm-tab') || '');
        });
    });

    applyTab('diagnostico');
})();
