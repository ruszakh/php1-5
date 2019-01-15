<?php

function getUsersList() {
    return ['Kolya' => '$2y$10$EJMJa0atrvcm4DYaaqbyfO9Y/HWN0.UiMfXZ3bPlpMYoqFPf5ZTNO',  //123456
    'Petya' => '$2y$10$CU1FXuNYP9Cjb7KNz8oOJuKxZei8c7Xn8ZIDPCNo2cM8DWy/3icEa',  //qwerty
    'Sasha' => '$2y$10$RDdOzFDktyfovMacgpTIVegLv4VX.O2GkL6dIFVy1eSOTgrY60KFO']; //111111
}

function existsUser($login) {
    return array_key_exists($login, getUsersList());
}

assert(true === existsUser('Kolya'));
assert(true === existsUser('Petya'));
assert(false === existsUser('Misha'));
assert(false === existsUser('Vasya'));

function checkPassword($login, $password) {
    return existsUser($login) && password_verify($password, getUsersList()[$login]);
}

assert(true === checkPassword('Kolya', '123456'));
assert(true === checkPassword('Petya', 'qwerty'));
assert(false === checkPassword('Kolya', 'qwerty'));
assert(false === checkPassword('Vasya', 'Misha'));

function getCurrentUser() {
    if (isset($_SESSION['user']) && existsUser($_SESSION['user'])) {
        return $_SESSION['user'];
    }
    return null;
}