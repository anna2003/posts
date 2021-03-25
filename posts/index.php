<?php
include $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
//show($_SESSION);
//show($user);
$posts = $dataPost->getAllPosts();

include $_SERVER['DOCUMENT_ROOT'] . '/posts/posts.view.php';