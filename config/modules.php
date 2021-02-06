<?php

return [
    'root' => [

        'requests' => [
            'trans' => 'requests',
            'status' => true,
            'fields' => [
                'attachment' => true,
            ]
        ],

        'switcher' => [
            'trans' => 'switcher',
            'status' => true,
            'fields' => [
                'index' => true,
            ],
        ],

        'dashboard' => [
            'trans' => 'dashboard',
            'status' => true,
            'fields' => [
                'index' => true,
            ]
        ],

        'pages' => [
            'trans' => 'pages',
            'status' => true,
            'fields' => [
                'index' => true,
                'visible' => true,
                'inside' => false,
                'show' => true,
                'trans' => true,
                'create' => true,
                'store' => true,
                'edit' => true,
                'update' => true,
                'destroy' => true
            ]
        ],

        'translation' => [
            'trans' => 'translation',
            'status' => true,
            'fields' => [
                'index' => true,
                // 'show'     =>   true,
                'create' => true,
                'store' => true,
                'edit' => true,
                'update' => true,
                'destroy' => true
            ]
        ],

        'languages' => [
            'trans' => 'languages',
            'status' => true,
            'fields' => [
                'create' => true,
                'store' => true,
            ]
        ],

        'media' => [
            'trans' => 'media',
            'status' => true,
            'fields' => [
                'index' => false,
                'files' => true,
                'images' => true,
                'show' => false,
                'create' => false,
                'store' => false,
                'edit' => false,
                'update' => false,
                'destroy' => false,
            ]
        ],

        'users' => [
            'trans' => 'users',
            'status' => true,
            'fields' => [
                'index' => true,
                'create' => true,
                'store' => true,
                'edit' => true,
                'update' => true,
                'show' => true,
                'destroy' => true
            ]
        ],

        'roles' => [
            'trans' => 'roles',
            'status' => true,
            'fields' => [
                'index' => true,
                'show' => true,
                'create' => true,
                'store' => true,
                'edit' => true,
                'update' => true,
                'destroy' => true,
            ]
        ],

        'banners' => [
            'trans' => 'banners',
            'status' => true,
            'fields' => [
                'index' => true,
                'create' => true,
                'store' => true,
                'show' => true,
                'visible' => true,
                'trans' => true,
                'edit' => true,
                'update' => true,
                'destroy' => true,
            ]
        ],

        'menus' => [
            'trans' => 'menus',
            'status' => true,
            'fields' => [
                'index' => true,
                'create' => true,
                'store' => true,
                'edit' => true,
                'update' => true,
                'visible' => true,
                'inside' => false, // TODO should be fixed, when inside menus are empty getList() rise errors!
                'trans' => true,
                'destroy' => true,
            ]
        ],

        'products' => [
            'trans' => 'products',
            'status' => true,
            'fields' => [
                'index' => true,
                'create' => true,
                'store' => true,
                'show' => true,
                'trans' => true,
                'edit' => true,
                'update' => true,
                'visible' => true,
                'destroy' => true,
            ]
        ],

        'sales' => [
            'trans' => 'sales',
            'status' => false, // In progress
            'fields' => [
                'index' => true,
            ]
        ],

        'posts' => [
            'trans' => 'posts',
            'status' => true,
            'fields' => [
                'index' => true,
                'create' => true,
                'store' => true,
                'show' => true,
                'edit' => true,
                'update' => true,
                'trans' => true,
                'visible' => true,
                'destroy' => true,
            ]
        ],

        'categories' => [
            'trans' => 'categories',
            'status' => true,
            'fields' => [
                'index' => true,
                'create' => true,
                'store' => true,
                'show' => true,
                'edit' => true,
                'update' => true,
                'trans' => true,
                'visible' => true,
                'destroy' => true,
            ]
        ],

        'sliders' => [
            'trans' => 'sliders',
            'status' => true,
            'fields' => [
                'index' => true,
                'create' => true,
                'store' => true,
                'edit' => true,
                'update' => true,
                'trans' => true,
                'visible' => true,
                'destroy' => true,
            ]
        ],

        'brands' => [
            'trans' => 'brands',
            'status' => true,
            'fields' => [
                'index' => true,
                'create' => true,
                'store' => true,
                'edit' => true,
                'update' => true,
                'trans' => true,
                'visible' => true,
                'destroy' => true,
            ]
        ],

        'tags' => [
            'trans' => 'tags',
            'status' => true,
            'fields' => [
                'index' => true,
                'create' => true,
                'store' => true,
                'edit' => true,
                'update' => true,
                'trans' => true,
                'visible' => true,
                'destroy' => true,
            ]
        ],

        'offers' => [
            'trans' => 'offers',
            'status' => true,
            'fields' => [
                'index' => true,
                'create' => true,
                'store' => true,
                'edit' => true,
                'update' => true,
                'trans' => true,
                'visible' => true,
                'destroy' => true,
            ]
        ],

    ]
];
