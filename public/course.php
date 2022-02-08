<?php

$data = [
    'title' => 'Available Courses',
    'extra_css' => [
        'mainframe.css',
        'course.css',
        'helped.css',
        'footer.css',
    ],

];

require_once __DIR__ . '/../templates/mainframe/baseWeb.phtml';
require_once __DIR__ . '/../templates/mainframe/coursePage.phtml';