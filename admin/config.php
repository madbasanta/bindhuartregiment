<?php

return [
    'app' => [
        'name' => 'Bindhu Art Regiment'
    ],
    'sidenav' => [
        '' => [
            ['name' => 'Dashboard', 'url' => '/admin']
        ],
        'CRM' => [
            [
                'name' => 'Articles', 'url' => '/admin/articles.*',
                'children' => [
                    ['name' => 'Create New', 'url' => '/admin/articles/create'],
                    ['name' => 'List All', 'url' => '/admin/articles']
                ]
            ],
            [
                'name' => 'Blogs', 'url' => '/admin/blogs.*',
                'children' => [
                    ['name' => 'Create New', 'url' => '/admin/blogs/create'],
                    ['name' => 'List All', 'url' => '/admin/blogs']
                ]
            ],
            [
                'name' => 'Podcasts', 'url' => '/admin/podcasts.*',
                'children' => [
                    ['name' => 'Create New', 'url' => '/admin/podcasts/create'],
                    ['name' => 'List All', 'url' => '/admin/podcasts']
                ]
            ],
        ],
        'FRONTEND' => [
            [
                'name' => 'Pages', 'url' => '/admin/pages.*',
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