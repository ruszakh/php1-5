<?php

include __DIR__ . '/functions/checkUsers.php';

session_start();

if (null !== getCurrentUser()) {
    unset($_SESSION['user']);
    header('Location: /index.php');
    exit();
}

?>

<a href="/">На главную</a>