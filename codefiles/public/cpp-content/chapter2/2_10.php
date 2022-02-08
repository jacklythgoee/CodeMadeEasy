<?php

$data = [
    'title' => 'C++ Chapter 2',
    'extra_css3' => [
        'mainframe.css',
        'lessons.css',
        'footer.css',
    ],
];

require_once __DIR__ . '/../../../templates/mainframe/baseWeb.phtml';
require_once __DIR__ . '/../../../templates/cpp-content/chapter2/chapter2_10.phtml';
