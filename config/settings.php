<?php

return [
    'root' => [
        'file_types' => [
            'images'   => ['jpg','png','gif','webp','tiff','psd','raw','bmp','heif','indd','jpeg','svg','ai'],
            'docs'     => ['doc','docx','odt','pdf','rtf','tex','txt','wpd','ods','xls','xlsx','xlsm','key','odp','pps','ppt','pptx'],
            'audios'   => ['aif','cda','mp3','mpa','ogg'],
            'videos'   => ['avi','mp4','mpg','mpeg','m4v','flv','3gp'],
            'compress' => ['deb','pkg','rar','rpm','tar.gz','zip','7z'],
            'data'     => ['csv','dat','db','dbf','log','mdb','sql','tar','xml'],
        ],

        'page_types' => [
            'static',
        ],

        'page_templates' => [
            'default'
        ],

        'menu_position' => [
            'top',
            'product',
        ],

        'menu_attachments' => [
            'pages',
            'categories',
        ],

        'banner_types' => [
            'default',
            'border'
        ],

        'post_templates' => [
            'default'
        ],

        'categories' => [
            'posts',
            'products',
        ],

        'slider_attachments' => [
            'posts',
            'products',
        ],

        'slider_positions' => [
            'top',
            'bottom'
        ],

        /* remove! */
        'event_shapes' => [
            'square',
            'rectangle'
        ],

        'event_attachments' => [
            'posts',
            'categories',
            'banners',
        ],

        'tags' => [
            'posts',
            'products',
        ],
    ]
];
