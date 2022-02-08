<?php

$data = [
    'title' => 'C++ Chapter 1',
    'extra_css3' => [
        'mainframe.css',
        'lessons.css',
        'footer.css',
    ],
];

require_once __DIR__ . '/../../../templates/mainframe/baseWeb.phtml';
require_once __DIR__ . '/../../../templates/cpp-content/chapter1/chapter1_4.phtml';
