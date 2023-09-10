<?php

return [
    'app' => [
        'name' => 'Bindhu Art Regiment'
    ],
    'database' => [
        'host' => getenv('DB_HOST'),
        'username' => getenv('DB_USERNAME'),
        'password' => getenv('DB_PASSWORD'),
        'database' => getenv('DB_DATABASE'),
    ],
    'sidenav' => [
        '' => [
            ['name' => 'Dashboard', 'url' => '/admin', 'icon' => 'bi bi-grid']
        ],
        'CRM' => [
            [
                'name' => 'Artists', 'url' => '/admin/artists.*', 'icon' => 'bi bi-badge-ad',
                'children' => [
                    ['name' => 'Create New', 'url' => '/admin/artists/create'],
                    ['name' => 'List All', 'url' => '/admin/artists']
                ]
            ],
            [
                'name' => 'Blogs', 'url' => '/admin/blogs.*', 'icon' => 'bi bi-badge-4k',
                'children' => [
                    ['name' => 'Create New', 'url' => '/admin/blogs/create'],
                    ['name' => 'List All', 'url' => '/admin/blogs']
                ]
            ],
            [
                'name' => 'Podcasts', 'url' => '/admin/podcasts.*', 'icon' => 'bi bi-megaphone',
                'children' => [
                    ['name' => 'Create New', 'url' => '/admin/podcasts/create'],
                    ['name' => 'List All', 'url' => '/admin/podcasts']
                ]
            ],
        ],
        'FRONTEND' => [
            [
                'name' => 'Pages', 'url' => '/admin/pages.*', 'icon' => 'bi bi-menu-button-wide',
                'children' => [
                    ['name' => 'About Us', 'url' => '/admin/pages/about'],
                    ['name' => 'Artist Profile', 'url' => '/admin/pages/artist'],
                    ['name' => 'Our Team', 'url' => '/admin/pages/team'],
                    ['name' => 'Support Us', 'url' => '/admin/pages/support']
                ]
            ]
        ]
    ]
];