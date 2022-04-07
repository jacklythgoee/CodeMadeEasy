<?php

declare(strict_types=1);

function login(PDO $db, string $username, string $password): bool                   // Authentication for login, will check the database for a match
{
    $sql = 'SELECT * FROM `users` WHERE username = :username';
    $stmt = $db->prepare($sql);
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        if (password_needs_rehash($user['password'], PASSWORD_DEFAULT)) {
            updatePassword($db, (int) $user['id'], $password);
        }

        $_SESSION['username'] = $user['username'];
        $_SESSION['userRole'] = $user['role'];
        return true;
    }

    return false;
}

