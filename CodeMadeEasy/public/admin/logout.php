<?php

require_once __DIR__ . '/../../bootstrap.php';

session_destroy();                      // Destorying session
header('Location: login.php');
exit;
