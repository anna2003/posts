<?php
session_start();

use App\db\Connect;
use App\models\Auth;
use App\models\Post;

include $_SERVER['DOCUMENT_ROOT'] . '/db/config.php';
include $_SERVER['DOCUMENT_ROOT'] . '/db/Connect.php';
include $_SERVER['DOCUMENT_ROOT'] . '/db/functions.php';
include $_SERVER['DOCUMENT_ROOT'] . '/models/Post.php';
include $_SERVER['DOCUMENT_ROOT'] . '/models/Auth.php';
include $_SERVER['DOCUMENT_ROOT'] . '/models/Validator.php';
include $_SERVER['DOCUMENT_ROOT'] . '/models/ShowData.php';

$user = isset($_SESSION['auth']) && $_SESSION['auth'] ? json_decode($_SESSION['user']) : false;

$pdo = Connect::make(CONN);
$dataPost = new Post($pdo);
$dataAuth = new Auth($pdo);

