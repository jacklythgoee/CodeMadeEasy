<?php

$data = [
    'title' => 'C++ Chapters',
    'extra_css2' => [
        'mainframe.css',
        'cppChapters.css',
        'footer.css',
    ],
];

require_once __DIR__ . '/../../templates/mainframe/baseWeb.phtml';
require_once __DIR__ . '/../../templates/cpp-content/cppChapters.phtml';

