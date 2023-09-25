<?php
require_once 'vendor/autoload.php';
require_once 'autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();


class Note
{
    private $pdo;
    public function connection() {
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $db = $_ENV['DB_NAME'];
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];
        $dsn = "mysql:dbname=$db;host=$host:$port";

        $this->pdo = new PDO(dsn: $dsn, username: $username, password: $password);
        $this->pdo->setAttribute(pdo::ATTR_ERRMODE, pdo::ERRMODE_EXCEPTION);
    
        return $this->pdo;
    }

    public function getNotes() {
        $sql = "SELECT * FROM `posts` ORDER BY created_at DESC;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function save($title, $note) {
        $query = "INSERT INTO notes (title, body) VALUES (:title, :body);";
        $params = array(
            ':title' => $title,
            ':body' => $note
        );
        $stmt = $this->connection()->prepare($query);
        return $stmt->execute($params);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM notes WHERE id = :id;";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}

