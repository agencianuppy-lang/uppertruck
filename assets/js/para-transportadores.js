(function () {
    var caseButtons = Array.from(document.querySelectorAll('[data-pt-case-tab]'));
    var caseHeadline = document.getElementById('pt-case-headline');
    var caseText = document.getElementById('pt-case-text');
    var caseMetric = document.getElementById('pt-case-metric');
    var caseCard = document.getElementById('pt-case-card');
    var caseDataScript = document.getElementById('pt-case-data');

    if (!caseButtons.length || !caseHeadline || !caseText || !caseMetric || !caseCard || !caseDataScript) {
        return;
    }

    var parsed = [];
    try {
        parsed = JSON.parse(caseDataScript.textContent || '[]');
    } catch (_error) {
        parsed = [];
    }

    if (!Array.isArray(parsed) || !parsed.length) {
        return;
    }

    var caseData = {};
    parsed.forEach(function (item) {
        if (!item || !item.key) {
            return;
        }
        caseData[item.key] = {
            headline: item.headline || '',
            text: item.text || '',
            metric: item.metric || ''
        };
    });

    function updateCaseTab(key) {
        var data = caseData[key];
        if (!data) {
            return;
        }

        caseButtons.forEach(function (button) {
            var isActive = button.getAttribute('data-pt-case-tab') === key;
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

    caseButtons.forEach(function (button) {
        button.addEventListener('click', function () {
            updateCaseTab(button.getAttribute('data-pt-case-tab') || '');
        });
    });

    updateCaseTab(caseButtons[0].getAttribute('data-pt-case-tab') || '');
})();
