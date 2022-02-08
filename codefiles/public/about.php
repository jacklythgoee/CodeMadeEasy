<?php

$data = [
    'title' => 'About CodeHeads',
    'extra_css' => [
        'mainframe.css',
        'about.css',
        'footer.css',
    ],

];
require_once __DIR__ . '/../templates/mainframe/baseWeb.phtml';
require_once __DIR__ . '/../templates/mainframe/aboutPage.phtml';

