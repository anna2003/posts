<?php

namespace App\models;

use PDO;

class Post
{
    protected $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllPosts()
    {
        $stmt = $this->pdo->query("SELECT posts.*, users.name as user_name FROM posts 
                                            INNER JOIN users ON posts.user_id= users.id
                                            ORDER BY created_at desc");
        return $stmt->fetchAll();
    }

    public function getOnePost($id)
    {
        $stmt = $this->pdo->prepare("SELECT posts.*, users.name as user_name FROM posts 
                                            INNER JOIN users ON posts.user_id= users.id
                                            WHERE posts.id = :id");
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch();
    }

    public function insertPost($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO posts (title, text, image, created_at, user_id)
                                            VALUES (:title, :text, :image, :created_at, :user_id)");
        $stmt->execute([
            'title' => $data['title'],
            'text' => $data['text'],
            'image' => $data['image'],
            'created_at' => date('Y-m-d'),
            'user_id' => $data['user_id']
        ]);
        return $this->pdo->lastInsertId();
    }

    public function deletePost($id)
    {
        $stmt = $this->pdo->prepare("DELETE FROM posts where id = :id");
        $stmt->execute([
            'id' => $id
        ]);
    }

    public function updatePost($data)
    {
        $stmt = $this->pdo->prepare("UPDATE posts SET title = :title, text = :text, 
                 image = :image, created_at = :created_at WHERE id = :id");

        $stmt->execute([
            'title' => $data['title'],
            'text' => $data['text'],
            'image' => $data['image'],
            'created_at' => date('Y-m-d'),
            'id' => $data['id']
        ]);
    }

}














