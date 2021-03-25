<?php
use App\models\Validator;
include $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (isset($_POST['submit'])) {
    unset($_SESSION['errors']['register']);
    $name = Validator::preProcessing($_POST['name']);
    $email = Validator::preProcessing($_POST['email']);
    $password = Validator::preProcessing($_POST['password']);
    if (Validator::validLength('Имя', $name, 'name', 2) &
        Validator::validLength('Email', $email, 'email') &
        Validator::validLength('Пароль', $password, 'password') &
        Validator::validEmail('Email', $email, 'email')
    ) {
        $id = $dataAuth->register($name, $email, $password);
        if ($id == -1) {
            $_SESSION['errors']['register'] = 'Пользователь с такими данными уже зарегистрирован в системе...';
        } else if ($id > 0) {
            $_SESSION['user'] = json_encode($dataAuth->find($id), JSON_UNESCAPED_UNICODE);
            $_SESSION['auth'] = true;
            header('Location: /');
            die();
        } else {
            $_SESSION['errors']['register'] = 'Попытка зарегистрироваться в системе закончилась неудачей...';
        }
    }
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    header('Location: /register');
}
