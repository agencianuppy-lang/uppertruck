(function () {
    const tabButtons = Array.from(document.querySelectorAll('[data-lm-tab]'));
    if (!tabButtons.length) {
        return;
    }

    const statusTitle = document.getElementById('lm-status-title');
    const statusText = document.getElementById('lm-status-text');
    const progressValue = document.getElementById('lm-progress-value');
    const progressBar = document.getElementById('lm-progress-bar');
    const planned = document.getElementById('lm-plan');
    const done = document.getElementById('lm-done');
    const issues = document.getElementById('lm-issues');
    const next = document.getElementById('lm-next');
    const windowField = document.getElementById('lm-window');
    const proof = document.getElementById('lm-proof');

    if (!statusTitle || !statusText || !progressValue || !progressBar || !planned || !done || !issues || !next || !windowField || !proof) {
        return;
    }

    const tabData = {
        'planejamento': {
            title: 'Rota planejada',
            text: 'Sequencia de entregas organizada por regiao, janela e prioridade.',
            progress: 20,
            plan: '18',
            done: '0',
            issues: '0',
            next: '18',
            window: '08:00 - 18:00',
            proof: '18'
        },
        'em-rota': {
            title: 'Entrega em andamento',
            text: 'Operacao acompanhada durante o percurso com leitura de status.',
            progress: 68,
            plan: '18',
            done: '12',
            issues: '2',
            next: '4',
            window: '08:00 - 18:00',
            proof: '6'
        },
        'entregue': {
            title: 'Operacao concluida',
            text: 'Entregas finalizadas com confirmacao e fechamento operacional.',
            progress: 100,
            plan: '18',
            done: '18',
            issues: '0',
            next: '0',
            window: 'Encerrada',
            proof: '0'
        }
    };

    const applyTab = (tabKey) => {
        const data = tabData[tabKey];
        if (!data) {
            return;
        }

        tabButtons.forEach((button) => {
            const isActive = button.getAttribute('data-lm-tab') === tabKey;
            button.classList.toggle('is-active', isActive);
            button.setAttribute('aria-selected', isActive ? 'true' : 'false');
        });

        statusTitle.textContent = data.title;
        statusText.textContent = data.text;
        progressValue.textContent = data.progress + '%';
        progressBar.style.width = data.progress + '%';
        planned.textContent = data.plan;
        done.textContent = data.done;
        issues.textContent = data.issues;
        next.textContent = data.next;
        windowField.textContent = data.window;
        proof.textContent = data.proof;
    };

    tabButtons.forEach((button) => {
        button.addEventListener('click', () => {
            applyTab(button.getAttribute('data-lm-tab') || '');
        });
    });

    applyTab('planejamento');
})();
