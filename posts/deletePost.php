<?php
include $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $post = $dataPost->getOnePost($id);

    // Пытаемся удалить файл на сервере
    deleteImg('../img/' . $post->image, $uploadPath);

    // Удаляем информацию из таблицы posts
    $dataPost->deletePost($id);

    // Возвращаемся на страницу со статьями
    header('Location: /posts');
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
