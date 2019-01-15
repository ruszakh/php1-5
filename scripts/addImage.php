<?php

include __DIR__ . '/../functions/checkUsers.php';

session_start();

if (null === getCurrentUser()) {
    ?>Загрузка доступна только авторизованным пользователям<br>
    <a href="/gallery.php">Назад</a>
    <?php die;
}

if (empty($_FILES['picture']) || (0 != $_FILES['picture']['error'])) {
    ?>Некорректный запрос<br>
    <a href="/gallery.php">Назад</a>
    <?php die;
}

if (
    'image/jpg' != $_FILES['picture']['type'] &&
    'image/jpeg' != $_FILES['picture']['type'] &&
    'image/png' != $_FILES['picture']['type']
) {
    ?>Некорректный формат файла<br>
    <a href="/gallery.php">Назад</a>
    <?php die;
}

move_uploaded_file(
    $_FILES['picture']['tmp_name'],
    __DIR__ . '/../images/' . $_FILES['picture']['name']
);

file_put_contents(__DIR__ . '/../logs.txt', $_SESSION['user'] . ' ' . date('Y-m-d H:i:s') . ' ' . $_FILES['picture']['name'] . "\n", FILE_APPEND);

header('Location: /gallery.php');

exit();