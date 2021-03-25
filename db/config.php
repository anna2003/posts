<?php
const CONN = [
    "host" => "localhost",
    "dbname" => "db_posts",
    "login" => "root",
    "password" => "root",
    "options" => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ]
];

$maxFileSize = 5*1024*1024;
$validFileTypes = ['image/jpg', 'image/jpeg', 'image/png'];
$uploadPath = $_SERVER['DOCUMENT_ROOT'] .'/img/';