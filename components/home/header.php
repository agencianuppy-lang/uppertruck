<header class="site-header" data-header>
    <div class="header-inner container-fluid">
        <a class="brand" href="/uppertruck/index.php" aria-label="Uppertruck - pagina inicial">
            <img src="/uppertruck/img/logo22.svg" alt="Uppertruck" width="156" height="38">
        </a>

        <nav class="desktop-nav" aria-label="Menu principal">
            <ul>
                <?php foreach ($menuItems as $item): ?>
                    <?php if (!empty($item['dropdown'])): ?>
                        <li class="has-dropdown">
                            <a href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                                <i class="dropdown-arrow" data-lucide="chevron-down" aria-hidden="true"></i>
                            </a>
                            <div class="dropdown-panel" role="menu" aria-label="Submenu Solucoes">
                                <?php foreach ($item['dropdown'] as $sub): ?>
                                    <a role="menuitem" href="<?php echo htmlspecialchars($sub['href'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <?php echo htmlspecialchars($sub['label'], ENT_QUOTES, 'UTF-8'); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </nav>

        <div class="header-actions">
            <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotacao</a>
            <button class="menu-toggle" data-menu-toggle aria-expanded="false" aria-controls="mobile-menu" aria-label="Abrir menu">
                <span></span>
                <span></span>
                <span></span>
            </button>
        </div>
    </div>

    <div class="mobile-menu" id="mobile-menu" data-mobile-menu>
        <nav aria-label="Menu mobile">
            <ul>
                <?php foreach ($menuItems as $item): ?>
                    <?php if (!empty($item['dropdown'])): ?>
                        <li>
                            <button class="mobile-submenu-toggle" data-mobile-submenu aria-expanded="false">
                                <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                                <i data-lucide="chevron-down" aria-hidden="true"></i>
                            </button>
                            <div class="mobile-submenu" hidden>
                                <a href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>">Visao geral</a>
                                <?php foreach ($item['dropdown'] as $sub): ?>
                                    <a href="<?php echo htmlspecialchars($sub['href'], ENT_QUOTES, 'UTF-8'); ?>">
                                        <?php echo htmlspecialchars($sub['label'], ENT_QUOTES, 'UTF-8'); ?>
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </li>
                    <?php else: ?>
                        <li>
                            <a href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>">
                                <?php echo htmlspecialchars($item['label'], ENT_QUOTES, 'UTF-8'); ?>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
            <a class="btn btn-primary mobile-cta" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotacao</a>
        </nav>
    </div>
</header>

<style>
    .whatsapp-floating {
        position: fixed;
        right: clamp(16px, 2.6vw, 30px);
        bottom: clamp(16px, 2.6vw, 30px);
        z-index: 220;
        min-height: 52px;
        padding: 10px 16px 10px 12px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        gap: 9px;
        background: #25d366;
        color: #06191d;
        font-size: 0.94rem;
        font-weight: 800;
        box-shadow: 0 18px 38px rgba(4, 18, 28, 0.28);
        transition: transform 180ms ease, box-shadow 180ms ease, background-color 180ms ease;
    }

    .whatsapp-floating:hover {
        transform: translateY(-2px);
        background: #36df74;
        box-shadow: 0 22px 44px rgba(4, 18, 28, 0.34);
    }

    .whatsapp-floating:focus-visible {
        outline: 3px solid #fff487;
        outline-offset: 3px;
    }

    .whatsapp-floating img {
        width: 24px;
        height: 24px;
        flex: 0 0 24px;
    }

    @media (max-width: 700px) {
        .whatsapp-floating {
            right: 14px;
            bottom: 14px;
            width: 54px;
            min-height: 54px;
            padding: 0;
            justify-content: center;
        }

        .whatsapp-floating span {
            position: absolute;
            width: 1px;
            height: 1px;
            overflow: hidden;
            clip: rect(0 0 0 0);
            white-space: nowrap;
        }
    }
</style>

<a class="whatsapp-floating" href="https://www.uppertruck.com/atendimento.php" aria-label="Atendimento pelo WhatsApp">
    <img src="/uppertruck/whatsapp-icone.png" alt="" width="24" height="24" aria-hidden="true">
    <span>Atendimento</span>
</a>
