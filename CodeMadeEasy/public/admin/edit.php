<?php

/**
 * This block is used to suppress errors about missing variable in PHPStorm
 * @var PDO $db
 */

require_once __DIR__ . '/../../bootstrap.php';


if (!isset($_SESSION['userRole'])) {            // Login Check
    header("Location:login.php");
    exit;
}

if ($_SESSION['userRole'] !== 'ADMIN') {
    header("Location:index.php");
    exit;
}

require_once __DIR__ . '/../../form.php';

$id = null;
$errors = [];

// Handle POST request
if (isset($_POST['page'], $_POST['id'])) {
    $id = (int) $_POST['id'];
    $errors = validateFormData(                 // Validating Form
        $_POST['contact_name'] ?? '',
        $_POST['contact_email'] ?? '',
        $_POST['contact_subject'] ?? '',
        $_POST['contact_message'] ?? ''
    );

    if (count($errors) === 0) {
        // No errors, update the record.            
        try {
            updateFormById(                
                $db,
                $id,
                $_POST['contact_name'],
                $_POST['contact_email'],
                $_POST['contact_subject'] ?? '',
                $_POST['contact_message'] ?? ''
            );
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => sprintf('Record with id %d has been updated successfully', $id),
                'id' => $id,
            ];
        } catch (PDOException $exception) {                     // If error, flash message appears
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => sprintf('Could not update record with id %d', $id)
            ];
        }
        header("Location:index.php?page=" . (int)$_POST['page']);       // Redirect to index.php
        exit;
    }
}

// Handle GET request
if ($id === null) {
    if (!isset($_GET['id'])) {
        $data = [
            'redirect' => 'index.php?page=' . ($_GET['page'] ?? 1),             // Setting redirect page
            'error' => 'Cannot edit unknown entry',                             // Setting error message
        ];
        require_once __DIR__ . '/../../templates/error.phtml';
        exit;
    }
    $id = (int) $_GET['id'];
}

try {
    $record = getFormById($db, $id);
} catch (RuntimeException $exception) {
    $data = [
        'redirect' => 'index.php?page=' . ($_GET['page'] ?? 1),
        'error' => ucfirst($exception->getMessage()),
    ];
    require_once __DIR__ . '/../../templates/error.phtml';
    exit;
}

// Template data
$data = [
    'title' => 'Form - Edit',                                       
    'extra_css' => [
        'create.css',
        'header.css',
    ],
    'action' => 'edit.php',
    'button' => 'Update',
    'currentPage' => $_GET['page'] ?? 1,
    'record' => $record,
    'errors' => $errors,
];
require_once __DIR__ . '/../../templates/crud/detail.phtml';
