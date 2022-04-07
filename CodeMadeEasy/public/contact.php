<?php

/**
 * This block is used to suppress errors about missing variable in PHPStorm
 * @var PDO $db
 */


require_once __DIR__ . '/../bootstrap.php';
require_once __DIR__ . '/../form.php';

if ($_POST) {
    $errors = validateFormData(                     //Validating Submitted form
        $_POST['contact_name'] ?? '',
        $_POST['contact_email'] ?? '',
        $_POST['contact_subject'] ?? '',
        $_POST['contact_message'] ?? ''
    );

    if (count($errors) === 0) {
        // No errors, create the record.           // Creating Form
        try {
            $id = createForm(
                $db,
                $_POST['contact_name'],
                $_POST['contact_email'],
                $_POST['contact_subject'],
                $_POST['contact_message'],
            );
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => sprintf('Successfully Submitted'),
                'id' => $id,
            ];
        } catch (PDOException $exception) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Could not create a new record'
            ];
        }

        header("Location:contact.php");
        exit;
    }
}

$data = [
    'title' => 'Contact us',
    'extra_css1' => [
        'contact.css',
        'mainframe.css',
    ],
    'flash' => $_SESSION['flash'] ?? null,
    'action' => 'contact.php'
];

// Clear flash data
if (isset($_SESSION['flash'])) {
    unset($_SESSION['flash']);
}
require_once __DIR__ . '../../templates/main/contact.phtml';
