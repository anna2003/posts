<?php
session_start();

use App\models\Validator;
include $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (isset($_POST['submitUpdate'])) {
    unset($_SESSION['errors']);

    // Формируем массив с данными для записи в БД
    $data['title'] = Validator::preProcessing($_POST['title']);
    $data['text'] =  Validator::preProcessing($_POST['text']);
    $data['id'] = $_POST['id'];

    // Находим нужную запись
    $post = $dataPost->getOnePost($data['id']);

    // Пытаемся загрузить файл на сервер
    [$errorLoad, $fileName] =
        loadImg($maxFileSize, $validFileTypes, $uploadPath, 'image');
    // Если файл не был загружен
    if ($_FILES['image']['error'] == UPLOAD_ERR_NO_FILE) {
        $fileName = $post->image;
        $errorLoad="";
    } else {
        // Пытаемся удалить файл на сервере
        deleteImg('../img/' . $post->image, $uploadPath);
    }
    // Если загрузка файла удалась:
    if (empty($errorLoad)) {
        $data['image'] = $fileName;

        // Записываем информацию в таблицу posts
        $dataPost->updatePost($data);

        // Возвращаемся на страницу со статьей
        header('Location: /posts/show.php?id=' . $data['id']);
    } // Иначе:
    else {
        $_SESSION['errors']['update'] = $errorLoad;
        // Возвращаемся на страницу редактирования записи
        header('Location: /posts/edit.php?id=' . $data['id']);
    }
}

//if(isset($_POST['deleteBtn'])) {
//    // Формируем массив с данными для записи в БД
//    $id=$_POST['id'];
//    $post = $dataPost->getOnePost($id);
//    // Пытаемся удалить файл на сервере
//    $error = deleteImg('../img/' . $post->image);
//
//    // Если загрузка файла удалась:
//    if (empty($error)) {
//        $_SESSION['msg'] = "Файл успешно удален";
//        $_SESSION['alert'] = 'alert-success';
//        // Удаляем информацию из таблицы posts
//        $dataPost->deletePost($id);
//        // Возвращаемся на страницу со статьями
//        header('Location: /posts');
//    }
//    // Иначе:
//    else {
//        $_SESSION['msg'] = $error;
//        $_SESSION['alert'] = 'alert-danger';
//        // Возвращаемся на страницу просмотра записи
//        header('Location: /posts/post.view.php');
//    }
//}
