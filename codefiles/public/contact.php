<?php

$data = [
    'title' => 'Contact Us',
    'extra_css' => [
        'mainframe.css',
        'contact.css',
        'footer.css',
    ],

];

require_once __DIR__ . '/../templates/mainframe/baseWeb.phtml';
require_once __DIR__ . '/../templates/mainframe/contactPage.phtml';