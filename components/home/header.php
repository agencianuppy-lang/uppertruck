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
