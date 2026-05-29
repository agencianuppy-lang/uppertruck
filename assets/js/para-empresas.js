(function () {
    const opsButtons = Array.from(document.querySelectorAll('[data-pe-ops-tab]'));
    const caseButtons = Array.from(document.querySelectorAll('[data-pe-case-tab]'));

    const opsStatus = document.getElementById('pe-tab-status');
    const opsNote = document.getElementById('pe-tab-note');
    const opsProgressValue = document.getElementById('pe-tab-progress-value');
    const opsProgressBar = document.getElementById('pe-tab-progress-bar');
    const statPickups = document.getElementById('pe-stat-pickups');
    const statDeliveries = document.getElementById('pe-stat-deliveries');
    const statIssues = document.getElementById('pe-stat-issues');
    const statSla = document.getElementById('pe-stat-sla');
    const statNext = document.getElementById('pe-stat-next');
    const statRoute = document.getElementById('pe-stat-route');

    const caseHeadline = document.getElementById('pe-case-headline');
    const caseText = document.getElementById('pe-case-text');
    const caseMetric = document.getElementById('pe-case-metric');
    const caseCard = document.getElementById('pe-case-card');

    const opsData = {
        coleta: {
            status: 'Operacao: Coletas em andamento',
            note: 'Coletas em andamento com roteirizacao e janela definidas.',
            progress: 34,
            pickups: '08',
            deliveries: '24',
            issues: '01 em tratativa',
            sla: 'Monitorado',
            next: '14:30',
            route: 'Urbana 07'
        },
        transito: {
            status: 'Operacao: Em transito',
            note: 'Veiculos em rota com acompanhamento de pontos criticos e atualizacao de status.',
            progress: 67,
            pickups: '08 concluidas',
            deliveries: '16 pendentes',
            issues: '02 em tratativa',
            sla: 'Sob controle',
            next: '15:00',
            route: 'Regional 12'
        },
        entrega: {
            status: 'Operacao: Entregas finais',
            note: 'Fechamento da jornada com confirmacao de entrega e leitura de performance.',
            progress: 100,
            pickups: '08 concluidas',
            deliveries: '24 concluidas',
            issues: '00 abertas',
            sla: 'Concluido',
            next: 'Encerrada',
            route: 'Ciclo finalizado'
        }
    };

    const caseData = {
        industria: {
            headline: 'Mais controle no transporte entre fornecedores, producao e clientes estrategicos.',
            text: 'Operacoes industriais podem usar a Uppertruck para organizar rotas recorrentes, reduzir ruidos e acompanhar entregas criticas com mais previsibilidade.',
            metric: 'Fluxo recorrente com prioridade operacional'
        },
        distribuicao: {
            headline: 'Rotas mais organizadas para quem entrega em multiplos destinos.',
            text: 'Distribuidores ganham previsibilidade ao estruturar coletas, entregas, janelas e acompanhamento operacional em uma rotina de maior escala.',
            metric: 'Maior clareza no cumprimento de janela e SLA'
        },
        varejo: {
            headline: 'Abastecimento mais previsivel para lojas, unidades e campanhas.',
            text: 'Redes varejistas podem contar com solucoes para entregas programadas, Last Mile e operacoes sazonais em diferentes regioes.',
            metric: 'Abastecimento com menor risco de ruptura'
        }
    };

    function updateOpsTab(key) {
        const data = opsData[key];
        if (!data || !opsStatus || !opsNote || !opsProgressValue || !opsProgressBar || !statPickups || !statDeliveries || !statIssues || !statSla || !statNext || !statRoute) {
            return;
        }

        opsButtons.forEach((button) => {
            const isActive = button.getAttribute('data-pe-ops-tab') === key;
            button.classList.toggle('is-active', isActive);
            button.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });

        opsStatus.textContent = data.status;
        opsNote.textContent = data.note;
        opsProgressValue.textContent = data.progress + '%';
        opsProgressBar.style.width = data.progress + '%';
        statPickups.textContent = data.pickups;
        statDeliveries.textContent = data.deliveries;
        statIssues.textContent = data.issues;
        statSla.textContent = data.sla;
        statNext.textContent = data.next;
        statRoute.textContent = data.route;
    }

    function updateCaseTab(key) {
        const data = caseData[key];
        if (!data || !caseHeadline || !caseText || !caseMetric || !caseCard) {
            return;
        }

        caseButtons.forEach((button) => {
            const isActive = button.getAttribute('data-pe-case-tab') === key;
            button.classList.toggle('is-active', isActive);
            button.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });

        caseCard.classList.add('is-switching');
        window.setTimeout(function () {
            caseHeadline.textContent = data.headline;
            caseText.textContent = data.text;
            caseMetric.textContent = data.metric;
            caseCard.classList.remove('is-switching');
        }, 120);
    }

    opsButtons.forEach((button) => {
        button.addEventListener('click', function () {
            updateOpsTab(button.getAttribute('data-pe-ops-tab') || 'coleta');
        });
    });

    caseButtons.forEach((button) => {
        button.addEventListener('click', function () {
            updateCaseTab(button.getAttribute('data-pe-case-tab') || 'industria');
        });
    });

    updateOpsTab('coleta');
    updateCaseTab('industria');
})();
