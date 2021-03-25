<?php

use App\models\Validator;
include $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (isset($_POST['submit'])) {
    $email = Validator::preProcessing($_POST['email']);
    $password = Validator::preProcessing($_POST['password']);
    $user = $dataAuth->auth($email, $password);
    if ($user) {
        $_SESSION['user'] =  json_encode($user, JSON_UNESCAPED_UNICODE);
        $_SESSION['auth'] = true;
        header('Location: /');
    } else {
        $_SESSION['errors']['auth'] = 'Неправильно введен логин или пароль...';
        $_SESSION['email'] = $email;
        $_SESSION['password'] = $password;
        header('Location: /auth');
    }
    echo $user;
}
