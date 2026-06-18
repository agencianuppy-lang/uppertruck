<header class="site-header" data-header>
    <div class="header-topbar">
        <div class="header-topbar-inner container-fluid">
            <span class="header-welcome">Seja bem-vindo</span>
            <div class="header-socials" aria-label="Redes sociais">
                <a href="https://www.instagram.com/uppertruck" target="_blank" rel="noopener" aria-label="Instagram da Uppertruck">
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <path d="M7.8 2h8.4C19.4 2 22 4.6 22 7.8v8.4c0 3.2-2.6 5.8-5.8 5.8H7.8C4.6 22 2 19.4 2 16.2V7.8C2 4.6 4.6 2 7.8 2Zm-.2 2A3.6 3.6 0 0 0 4 7.6v8.8A3.6 3.6 0 0 0 7.6 20h8.8a3.6 3.6 0 0 0 3.6-3.6V7.6A3.6 3.6 0 0 0 16.4 4H7.6Zm9.65 1.65a1.1 1.1 0 1 1 0 2.2 1.1 1.1 0 0 1 0-2.2ZM12 7a5 5 0 1 1 0 10 5 5 0 0 1 0-10Zm0 2a3 3 0 1 0 0 6 3 3 0 0 0 0-6Z" />
                    </svg>
                </a>
                <a href="https://facebook.com/uppertruck" target="_blank" rel="noopener" aria-label="Facebook da Uppertruck">
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <path d="M14 8.4V6.9c0-.7.24-1.1 1.24-1.1h1.9V2.2A25.5 25.5 0 0 0 14.36 2C11.58 2 9.7 3.7 9.7 6.82V8.4H6.58v3.92H9.7V22h4.12v-9.68h3.05l.48-3.92H14Z" />
                    </svg>
                </a>
                <a href="https://www.linkedin.com/company/uppertruckoficial" target="_blank" rel="noopener" aria-label="LinkedIn da Uppertruck">
                    <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                        <path d="M6.94 8.95H3.04V21h3.9V8.95ZM5 3a2.26 2.26 0 1 0 0 4.52A2.26 2.26 0 0 0 5 3Zm16 11.4c0-3.46-1.85-5.07-4.32-5.07a3.73 3.73 0 0 0-3.39 1.86h-.05V8.95H9.5V21h3.9v-5.96c0-1.57.3-3.1 2.25-3.1 1.92 0 1.95 1.8 1.95 3.2V21H21v-6.6Z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
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
