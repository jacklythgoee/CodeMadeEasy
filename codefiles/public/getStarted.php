<?php

$data = [
    'title' => 'Get Started',
    'extra_css1' => [
        'mainframe.css',
        'getStarted.css',
        'footer.css',
    ],

];
require_once __DIR__ . '/../templates/mainframe/baseWeb.phtml';
require_once __DIR__ . '/../templates/mainframe/getStartedPage.phtml';