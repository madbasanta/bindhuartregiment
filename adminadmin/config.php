<?php

return [
    'app' => [
        'name' => 'Bindhu Art Regiment'
    ],
    'database' => [
        'host' => 'localhost',
        'username' => 'root',
        'password' => 'root',
        'database' => 'bindhuartregiment'
    ],
    'sidenav' => [
        '' => [
            ['name' => 'Dashboard', 'url' => '/admin', 'icon' => 'bi bi-grid']
        ],
        'CRM' => [
            [
                'name' => 'Articles', 'url' => '/admin/articles.*', 'icon' => 'bi bi-badge-ad',
                'children' => [
                    ['name' => 'Create New', 'url' => '/admin/articles/create'],
                    ['name' => 'List All', 'url' => '/admin/articles']
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