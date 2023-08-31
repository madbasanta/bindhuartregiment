<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

        <?php foreach (config('sidenav') as $groupText => $sidenavMenu) : ?>

            <?php foreach ($sidenavMenu as $menu) : ?>
                <?php if (array_key_exists('children', $menu)) : ?>
                    <li class="nav-item">
                        <a class="nav-link <?= is_route($menu['url']) ? 'active' : 'collapsed' ?>" data-bs-target="#components-nav-<?= str_replace(' ', '_', $menu['name']) ?>" data-bs-toggle="collapse" href="#">
                            <i class="<?= $menu['icon'] ?>"></i>
                            <span><?= $menu['name'] ?></span><i class="bi bi-chevron-down ms-auto"></i>
                        </a>
                        <ul id="components-nav-<?= str_replace(' ', '_', $menu['name']) ?>" class="nav-content collapse <?= is_route($menu['url']) ? 'show' : '' ?>" data-bs-parent="#sidebar-nav">
                            <?php foreach ($menu['children'] as $subMenu) : ?>
                                <li>
                                    <a href="<?= $subMenu['url'] ?>" class="<?= is_route($subMenu['url']) ? 'active' : '' ?>">
                                        <i class="bi bi-circle"></i><span><?= $subMenu['name'] ?></span>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php else : ?>
                    <li class="nav-item">
                        <a class="nav-link " href="<?= $menu['url'] ?>">
                            <i class="<?= $menu['icon'] ?>"></i>
                            <span><?= $menu['name'] ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>

    </ul>

</aside><!-- End Sidebar-->