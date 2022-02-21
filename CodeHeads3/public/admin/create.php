<?php

/**
 * This block is used to suppress errors about missing variable in PHPStorm
 * @var PDO $db
 */


require_once __DIR__ . '/../../bootstrap.php';

if (!isset($_SESSION['userRole'])) {
    header("Location:login.php");
    exit;
}

if ($_SESSION['userRole'] !== 'USER' && $_SESSION['userRole'] !== 'ADMIN') {
    header("Location:index.php");
    exit;
}

$errors = [];

require_once __DIR__ . '/../survey.php';
if (isset($_POST['page'])) {
    $errors = validateSurveyData(
        $_POST['contact_name'] ?? '',
        $_POST['contact_email'] ?? '',
        $_POST['contact_subject'] ?? '',
        $_POST['contact_message'] ?? ''

    );

    if (count($errors) === 0) {
        // No errors, create the record.
        try {
            $id = createSurvey(
                $db,
                $_POST['contact_name'],
                $_POST['contact_email'],
                $_POST['contact_subject'],
                $_POST['contact_message']
            );
            $_SESSION['flash'] = [
                'type' => 'success',
                'message' => sprintf('Record with id %d has been created successfully', $id),
                'id' => $id,
            ];
        } catch (PDOException $exception) {
            $_SESSION['flash'] = [
                'type' => 'danger',
                'message' => 'Could not create a new record'
            ];
        }

        header("Location:index.php?page=" . (int)$_POST['page']);
        exit;
    }
}

// Template data
$data = [
    'title' => 'Survey - Create',
    'extra_css' => [
        'overview.css',
        'create.css',
        'style.css',
        'https://use.fontawesome.com/releases/v5.15.4/css/all.css',
    ],
    'action' => 'create.php',
    'button' => 'Create',
    'currentPage' => $_GET['page'] ?? 1,
    'record' => [], // You can use this array to prefill the "create" form using the POST data.
    'errors' => $errors,
];
require_once __DIR__ . '/../templates/header.phtml';
require_once __DIR__ . '/../templates/detail.phtml';
