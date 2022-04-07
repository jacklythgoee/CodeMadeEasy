<?php

declare(strict_types=1);

// This file contains every thing needed to create a database connection.

if (!isset($settings) || !array_key_exists('database', $settings)) {
    throw new Exception('database configuration does not exist');
}

try {
    $db = new PDO(
        $settings['database']['dsn'],
        $settings['database']['username'],
        $settings['database']['password'],
        $settings['database']['options']
    );
} catch (PDOException $exception) {
    die($exception->getMessage());
}
