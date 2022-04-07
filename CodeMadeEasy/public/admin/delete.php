<?php

/**
 * This block is used to suppress errors about missing variable in PHPStorm
 * @var PDO $db
 */

require_once __DIR__ . '/../../bootstrap.php';

if (!isset($_SESSION['userRole'])) {    // User logged in Check
    header("Location:login.php");
    exit;
}

if ($_SESSION['userRole'] !== 'ADMIN') {
    header("Location:index.php");
    exit;
}

if (!isset($_GET['id'])) {
    $data = [
        'redirect' => 'index.php?page=' . ($_GET['page'] ?? 1),     //Sets redirect page
        'error' => 'Cannot delete a unknown entity'                 //Sets error message
    ];
    require_once __DIR__ . '/../../templates/crud/error.phtml';
    exit;
}
$id = (int) $_GET['id'];

require_once __DIR__ . '/../../form.php';                       // Requiring form for the functions

try {
    $record = getFormById($db, (int) $id);                      //Gathering Form
} catch (RuntimeException $exception) {
    $data = [
        'redirect' => 'index.php?page=' . ($_GET['page'] ?? 1),
        'error' => ucfirst($exception->getMessage()),
    ];
    require_once __DIR__ . '/../../templates/crud/error.phtml';
    exit;
}

try {
    deleteFormById($db, $id);                                       // Deleting form
    $_SESSION['flash'] = [
        'type' => 'success',
        'message' => sprintf('Record with id %d has been deleted successfully', $id),
    ];
} catch (PDOException $exception) {                                 // If error, it will display message
    $_SESSION['flash'] = [
        'type' => 'danger',
        'message' => sprintf('Could not delete record with %d', $id),
    ];
}

header("Location:index.php?page=" . ($_GET['page'] ?? 1));          // Redirect to index.php
exit;


