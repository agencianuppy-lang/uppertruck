(function () {
    "use strict";

    const config = {
        territoriesAvailable: 87,
        territoriesTotal: 120,
        defaultRegion: "Sudeste",
        defaultTerritory: "Capitais e regiões metropolitanas"
    };

    const monthlyFormat = new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
        maximumFractionDigits: 0
    });

    const numberFormat = new Intl.NumberFormat("pt-BR");

    const fretesInput = document.getElementById("fretesInput");
    const fretesRange = document.getElementById("fretesRange");
    const ticketInput = document.getElementById("ticketInput");
    const ticketRange = document.getElementById("ticketRange");

    const simFaturamentoMensal = document.getElementById("simFaturamentoMensal");
    const simFaturamentoAnual = document.getElementById("simFaturamentoAnual");
    const simTicket = document.getElementById("simTicket");
    const heroProjection = document.getElementById("heroProjection");
    const fretesBar = document.getElementById("fretesBar");
    const ticketBar = document.getElementById("ticketBar");

    const formFretesMensais = document.getElementById("formFretesMensais");
    const formTicketMedio = document.getElementById("formTicketMedio");
    const formFaturamentoEstimado = document.getElementById("formFaturamentoEstimado");

    const regiaoInput = document.getElementById("regiao_interesse");
    const territorioInput = document.getElementById("territorio_interesse");
    const mapRegions = Array.from(document.querySelectorAll(".map-region"));
    const regionCards = Array.from(document.querySelectorAll(".region-card"));

    const territoryRing = document.getElementById("territoryRing");
    const territoryProgress = document.getElementById("territoryProgress");
    const territoryCount = document.getElementById("territoriosDisponiveis");
    const territoryStatus = document.getElementById("territoryStatus");

    const estadoInput = document.getElementById("estado");
    const whatsappInput = document.getElementById("whatsapp");
    const form = document.getElementById("leadForm");
    const submitLead = document.getElementById("submitLead");

    function clamp(value, min, max) {
        return Math.min(max, Math.max(min, value));
    }

    function toNumber(value, fallback) {
        const parsed = Number(value);
        return Number.isFinite(parsed) ? parsed : fallback;
    }

    function syncPair(numberInput, rangeInput, source) {
        if (source === numberInput) {
            rangeInput.value = numberInput.value;
        } else {
            numberInput.value = rangeInput.value;
        }
    }

    function updateSimulator() {
        const fretes = clamp(Math.round(toNumber(fretesInput.value, 60)), 20, 600);
        const ticket = clamp(Math.round(toNumber(ticketInput.value, 3500)), 500, 15000);

        fretesInput.value = fretes;
        fretesRange.value = fretes;
        ticketInput.value = ticket;
        ticketRange.value = ticket;

        const monthly = fretes * ticket;
        const yearly = monthly * 12;

        simFaturamentoMensal.textContent = monthlyFormat.format(monthly);
        simFaturamentoAnual.textContent = monthlyFormat.format(yearly);
        simTicket.textContent = monthlyFormat.format(ticket);
        heroProjection.textContent = `${monthlyFormat.format(monthly)}/mensal`;

        const fretesPercent = ((fretes - 20) / (600 - 20)) * 100;
        const ticketPercent = ((ticket - 500) / (15000 - 500)) * 100;
        fretesBar.style.width = `${fretesPercent}%`;
        ticketBar.style.width = `${ticketPercent}%`;

        formFretesMensais.value = String(fretes);
        formTicketMedio.value = String(ticket);
        formFaturamentoEstimado.value = monthly.toFixed(2);
    }

    function stepInput(targetId, delta) {
        const target = document.getElementById(targetId);
        if (!target) return;
        const current = toNumber(target.value, 0);
        target.value = String(current + delta);
        if (targetId === "fretesInput") {
            syncPair(fretesInput, fretesRange, fretesInput);
        } else if (targetId === "ticketInput") {
            syncPair(ticketInput, ticketRange, ticketInput);
        }
        updateSimulator();
    }

    function selectRegion(regionName, territoryHint) {
        mapRegions.forEach((node) => {
            node.classList.toggle("is-active", node.getAttribute("data-region") === regionName);
        });

        regionCards.forEach((card) => {
            card.classList.toggle("active", card.getAttribute("data-region") === regionName);
        });

        regiaoInput.value = regionName;

        if (!territorioInput.value || territoryHint) {
            territorioInput.value = territoryHint || config.defaultTerritory;
        }
    }

    function animateCounter(element, target, suffix) {
        const duration = 1100;
        const start = performance.now();

        function frame(now) {
            const progress = Math.min((now - start) / duration, 1);
            const eased = 1 - Math.pow(1 - progress, 3);
            const value = Math.round(target * eased);
            element.textContent = `${numberFormat.format(value)}${suffix}`;
            if (progress < 1) {
                requestAnimationFrame(frame);
            }
        }

        requestAnimationFrame(frame);
    }

    function setupReveal() {
        const revealNodes = document.querySelectorAll("[data-reveal]");
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target);
                });
            },
            { threshold: 0.15, rootMargin: "0px 0px -10% 0px" }
        );

        revealNodes.forEach((node) => observer.observe(node));
    }

    function setupCounters() {
        const counters = document.querySelectorAll("[data-counter]");
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (!entry.isIntersecting) return;
                    const element = entry.target;
                    if (element.dataset.animated === "true") return;
                    element.dataset.animated = "true";
                    const target = toNumber(element.dataset.counter, 0);
                    const suffix = element.dataset.suffix || "";
                    animateCounter(element, target, suffix);
                    observer.unobserve(element);
                });
            },
            { threshold: 0.8 }
        );

        counters.forEach((counter) => observer.observe(counter));
    }

    function setupTerritoryVisual() {
        const available = config.territoriesAvailable;
        const total = config.territoriesTotal;
        const occupied = Math.max(total - available, 0);
        const availablePercent = clamp((available / total) * 100, 0, 100);

        territoryRing.style.setProperty("--ring-percent", `${availablePercent}%`);
        territoryProgress.style.width = `${availablePercent}%`;
        territoryStatus.textContent = `${numberFormat.format(occupied)} territórios já estão em fase de ocupação operacional.`;

        let current = 0;
        const step = Math.max(Math.ceil(available / 42), 1);
        const timer = setInterval(() => {
            current += step;
            if (current >= available) {
                current = available;
                clearInterval(timer);
            }
            territoryCount.textContent = numberFormat.format(current);
        }, 24);
    }

    function setupMaskAndInputBehavior() {
        if (window.IMask && whatsappInput) {
            IMask(whatsappInput, { mask: "(00) 00000-0000" });
        }

        if (estadoInput) {
            estadoInput.addEventListener("input", () => {
                estadoInput.value = estadoInput.value.replace(/[^a-zA-Z]/g, "").toUpperCase().slice(0, 2);
            });
        }
    }

    function showSuccess() {
        if (window.Swal) {
            Swal.fire({
                icon: "success",
                title: "Solicitação enviada",
                text: "Recebemos seus dados. Nosso time comercial entrará em contato em breve.",
                confirmButtonText: "Fechar"
            });
            return;
        }
        alert("Solicitação enviada com sucesso.");
    }

    function showError(message) {
        if (window.Swal) {
            Swal.fire({
                icon: "error",
                title: "Não foi possível enviar",
                text: message || "Tente novamente em instantes.",
                confirmButtonText: "Fechar"
            });
            return;
        }
        alert(message || "Erro ao enviar.");
    }

    async function submitLeadForm(event) {
        event.preventDefault();
        if (!form.checkValidity()) {
            form.reportValidity();
            return;
        }

        if (!regiaoInput.value) {
            regiaoInput.value = config.defaultRegion;
        }

        updateSimulator();

        submitLead.disabled = true;
        const originalLabel = submitLead.textContent;
        submitLead.textContent = "Enviando...";

        try {
            const payload = new FormData(form);
            const response = await fetch("admin-cadastropositivo/api/salvar-licenciamento.php", {
                method: "POST",
                body: payload
            });
            const result = await response.json();
            if (!response.ok || !result.ok) {
                throw new Error(result.message || "Não foi possível concluir o envio.");
            }

            showSuccess();

            form.reset();
            selectRegion(config.defaultRegion, config.defaultTerritory);
            fretesInput.value = "60";
            ticketInput.value = "3500";
            updateSimulator();
        } catch (error) {
            showError(error.message || "Erro no envio.");
        } finally {
            submitLead.disabled = false;
            submitLead.textContent = originalLabel;
        }
    }

    function setupAnchors() {
        document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
            anchor.addEventListener("click", (event) => {
                const href = anchor.getAttribute("href");
                if (!href || href.length < 2) return;
                const target = document.querySelector(href);
                if (!target) return;
                event.preventDefault();
                target.scrollIntoView({ behavior: "smooth", block: "start" });
            });
        });
    }

    function wireEvents() {
        fretesInput.addEventListener("input", () => {
            syncPair(fretesInput, fretesRange, fretesInput);
            updateSimulator();
        });
        fretesRange.addEventListener("input", () => {
            syncPair(fretesInput, fretesRange, fretesRange);
            updateSimulator();
        });

        ticketInput.addEventListener("input", () => {
            syncPair(ticketInput, ticketRange, ticketInput);
            updateSimulator();
        });
        ticketRange.addEventListener("input", () => {
            syncPair(ticketInput, ticketRange, ticketRange);
            updateSimulator();
        });

        document.querySelectorAll("[data-step-target]").forEach((button) => {
            button.addEventListener("click", () => {
                const targetId = button.getAttribute("data-step-target");
                const step = toNumber(button.getAttribute("data-step"), 0);
                stepInput(targetId, step);
            });
        });

        document.querySelectorAll("[data-preset-fretes]").forEach((button) => {
            button.addEventListener("click", () => {
                fretesInput.value = button.getAttribute("data-preset-fretes") || "60";
                ticketInput.value = button.getAttribute("data-preset-ticket") || "3500";
                syncPair(fretesInput, fretesRange, fretesInput);
                syncPair(ticketInput, ticketRange, ticketInput);
                updateSimulator();
            });
        });

        mapRegions.forEach((node) => {
            node.addEventListener("click", () => {
                const region = node.getAttribute("data-region") || config.defaultRegion;
                const linkedCard = regionCards.find((card) => card.getAttribute("data-region") === region);
                const territory = linkedCard ? linkedCard.getAttribute("data-territory") : config.defaultTerritory;
                selectRegion(region, territory);
            });
        });

        regionCards.forEach((card) => {
            card.addEventListener("click", () => {
                const region = card.getAttribute("data-region") || config.defaultRegion;
                const territory = card.getAttribute("data-territory") || config.defaultTerritory;
                selectRegion(region, territory);
            });
        });

        form.addEventListener("submit", submitLeadForm);
    }

    function init() {
        setupReveal();
        setupCounters();
        setupTerritoryVisual();
        setupMaskAndInputBehavior();
        setupAnchors();
        wireEvents();
        selectRegion(config.defaultRegion, config.defaultTerritory);
        updateSimulator();
    }

    init();
})();
