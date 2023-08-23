<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <?php foreach(config('sidenav') as $groupText => $sidenavMenu): ?>
                    <?php if($groupText) : ?>
                        <div class="sb-sidenav-menu-heading"><?= $groupText ?></div>
                    <?php endif; ?>
                    <?php foreach($sidenavMenu as $menu): ?>
                        <?php if(array_key_exists('children', $menu)): ?>
                            <a class="nav-link <?= is_route($menu['url']) ? 'active' : 'collapsed' ?>" href="#" data-bs-toggle="collapse" data-bs-target="#collapse<?= str_replace(' ', '_', $menu['name']) ?>" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                <?= $menu['name'] ?>
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse <?= is_route($menu['url']) ? 'show' : '' ?>" id="collapse<?= str_replace(' ', '_', $menu['name']) ?>" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <?php foreach($menu['children'] as $subMenu): ?>
                                        <a class="nav-link <?= is_route($subMenu['url']) ? 'active' : '' ?>" href="<?= $subMenu['url'] ?>"><?= $subMenu['name'] ?></a>
                                    <?php endforeach; ?>
                                </nav>
                            </div>
                        <?php else: ?>
                            <a class="nav-link <?= is_route($menu['url']) ? 'active' : '' ?>" href="<?= $menu['url'] ?>"><?= $menu['name'] ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= auth()['name'] ?>
        </div>
    </nav>
</div>