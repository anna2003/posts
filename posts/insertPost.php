<?php

use App\models\Validator;
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (isset($_POST['submitInsert']) & $user) {
    unset($_SESSION['errors']);
    unset($_SESSION['post']);

    $title = Validator::preProcessing($_POST['title']);
    $text = Validator::preProcessing($_POST['text']);

    if (Validator::validLength('Название статьи', $title, 'title', 2) &
        Validator::validLength('Текст статьи', $text, 'text')
    ) {
        // Формируем массив с данными для записи в БД
        $data['title'] = $title;
        $data['text'] = $text;
        $data['user_id'] = $user->id;
        // Пытаемся загрузить файл на сервер
        [$error, $fileName] =
            loadImg($maxFileSize, $validFileTypes, $uploadPath, 'image');

        // Если загрузка файла удалась:
        if (empty($error)) {
            $data['image'] = $fileName;
            // Записываем информацию в таблицу posts
            $dataPost->insertPost($data);
            // Возвращаемся на страницу со статьями
            header('Location: /posts');
        } // Иначе:
        else {
            $_SESSION['errors']['insert'] = $error;
            $_SESSION['post']['title'] = $_POST['title'];
            $_SESSION['post']['text'] = $_POST['text'];

            // Возвращаемся на страницу добавления записи
            header('Location: /posts/new.php');
        }
    }
}
