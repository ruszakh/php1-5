<?php

include __DIR__ . '/functions/checkUsers.php';

session_start();

if (isset($_SESSION['user'])) {
    header('Location: /index.php');
    exit();
}
?>

<form method="post" action="/login.php">
    <input type="text" name="user" placeholder="Логин">
    <br>
    <input type="password" name="password" placeholder="Пароль">
    <br>
    <button type="submit">Войти</button>
</form>

<?php

if (isset($_POST['user']) && isset($_POST['password'])) {
    if (checkPassword($_POST['user'], $_POST['password'])) {
        $_SESSION['user'] = $_POST['user'];
    }
}
