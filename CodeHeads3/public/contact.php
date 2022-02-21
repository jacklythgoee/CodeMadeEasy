<?php
require_once __DIR__ . '/../bootstrap.php';
$errors = [];

require_once __DIR__ . '/../survey.php';
    if (isset($_POST['page'])) {
        $errors = validateFormData(
            $_POST['contact_name'] ?? '',
            $_POST['contact_email'] ?? '',
            $_POST['contact_subject'] ?? '',
            $_POST['contact_message'] ?? ''

        );

    if (count($errors) === 0) {
        // No errors, create the record.
        try {
            $id = createForm(
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

        header("Location:contact.php");
        exit;
    }
}

$data = [
    'title' => 'Contact us',
    'extra_css2' => [
        'contact.css',
        'mainframe.css',
        
    ],
    'action' => 'contact.php',
    'button' => 'Create',
    'currentPage' => $_GET['page'] ?? 1,
    'record' => [], // You can use this array to prefill the "create" form using the POST data.
    'errors' => $errors,
];
require_once __DIR__ . '../../templates/contact.phtml';
