<?php

require_once 'vendor/autoload.php';
require_once 'autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


class User
{
    private $id;
    private $name;
    private $email;
    private $password;
    private $created_at;
    private $updated_at;

    public function __construct(int $id = null, $name = null, $email = null, $password = null, $created_at = null, $updated_at = null)
    {
        if ($id !== null) {
            $this->setId($id);
            $this->setName($name);
            $this->setEmail($email);
            $this->setPassword($password);
            $this->setCreatedAt($created_at);
            $this->setUpdatedAt($updated_at);
        }
    }

    public function save($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');

        $sql = "INSERT INTO users (username, email, password, created_at, updated_at) VALUES (:name, :email, :password, :created_at, :updated_at);";

        $stmt = Connection::getInstance()->connect()->prepare($sql);

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':password', $this->password);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);

        return $stmt->execute();
    }

    public function signIn($email, $password)
    {
        $this->email = $email;
        $this->password = $password;

        $sql = "SELECT * FROM users WHERE email = :email;";

        $stmt = Connection::getInstance()->connect()->prepare($sql);

        $stmt->bindParam(':email', $this->email);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_CLASS, 'User');
    }

    //getters and setters
    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;
    }
    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }
    public function getId(): int
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
    }
}