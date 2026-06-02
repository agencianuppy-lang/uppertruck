<header class="site-header" data-header>
    <div class="header-inner container-fluid">
        <a class="brand" href="/uppertruck/index.php" aria-label="Uppertruck - página inicial">
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
                            <div class="dropdown-panel" role="menu" aria-label="Submenu Soluções">
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
            <a class="btn btn-primary" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotação</a>
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
                                <a href="<?php echo htmlspecialchars($item['href'], ENT_QUOTES, 'UTF-8'); ?>">Visão geral</a>
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
            <a class="btn btn-primary mobile-cta" href="/uppertruck/cotacao-contato/solicitar-cotacao.php">Solicitar cotação</a>
        </nav>
    </div>
</header>

<style>
.whatsapp-floating { position: fixed; right: 22px; bottom: 22px; min-height: 58px; padding: 13px 18px; border-radius: 999px; background: #fbd749; color: #061427; display: inline-flex; align-items: center; justify-content: center; gap: 10px; font-family: 'Sora', sans-serif; font-size: 0.9rem; font-weight: 800; line-height: 1; text-decoration: none; box-shadow: 0 16px 36px rgba(7,33,86,.28); z-index: 999; transition: transform .2s ease, box-shadow .2s ease; }
.whatsapp-floating:hover { transform: translateY(-3px); box-shadow: 0 20px 44px rgba(7,33,86,.34); color: #061427; }
.whatsapp-floating img { width: 26px; height: 26px; display: block; flex: 0 0 auto; background: #0b1b26; border-radius: 1rem; padding: 0; }
.whatsapp-floating span { white-space: nowrap; }
@media (max-width: 640px) { .whatsapp-floating { right: 16px; bottom: 16px; min-height: 54px; padding: 12px 15px; font-size: 0.78rem; } .whatsapp-floating img { width: 24px; height: 24px; } }
</style>
<a class="whatsapp-floating" href="https://www.uppertruck.com/atendimento.php" target="_blank" rel="noopener" aria-label="Atendimento rápido via WhatsApp">
    <img src="/uppertruck/img/whatsapp-white.png" alt="" width="24" height="24" aria-hidden="true">
    <span>Atendimento rápido</span>
</a>
