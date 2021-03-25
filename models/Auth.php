<?php
namespace App\models;
use PDO;

class Auth
{
    private $pdo;
    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function auth($email, $password)
    {
//        $stmt = $this->pdo->prepare("select * from users
//                    WHERE email = :email and password = :password");
//        $stmt->execute([
//            'email' => $email,
//            'password' => $password,
//        ]);
//        return $stmt->fetch();
        $stmt = $this->pdo->prepare("select * from users WHERE email = :email");
        $stmt->execute([
            'email' => $email,
        ]);
        $user = $stmt->fetch();
        if ($user) {
            if (!password_verify($password, $user->password)) {
                return $user;
//                $user = false;
            }
        };
        return false;
//        echo json_encode($user);
    }

    public function find($id)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute([
            'id' => $id
        ]);
        return $stmt->fetch();
    }

    public function posts($user_id)
    {
        $stmt = $this->pdo->prepare("SELECT posts.* FROM posts
                INNER JOIN users ON posts.user_id=users.id WHERE posts.user_id = :user_id
                ORDER BY created_at desc");
        $stmt->execute([
            'user_id' => $user_id
        ]);
        return $stmt->fetchAll();
    }

    public function register($name, $email, $password)
    {
        if ($this->auth($email, $password)) {
            return -1;
        }
        $stmt = $this->pdo->prepare("insert into users (name, email, password)
                        values(:name, :email, :password)");
        $stmt->execute([
            'name' => $name,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);
        return $this->pdo->lastInsertId();
    }
}