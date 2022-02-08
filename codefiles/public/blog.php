<?php

$data = [
    'title' => 'Blog',
    'extra_css1' => [
        'mainframe.css',
        'blog.css',
        'footer.css',
    ],

];

require_once __DIR__ . '/../templates/mainframe/baseWeb.phtml';
require_once __DIR__ . '/../templates/mainframe/blogPage.phtml';