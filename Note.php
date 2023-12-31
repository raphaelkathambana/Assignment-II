<?php
require_once 'vendor/autoload.php';
require_once 'autoload.php';

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

class Note
{

    private $id;
    private $title;
    private $body;
    private $user_id;
    private $created_at;
    private $updated_at;

    public function __construct($id = null, $title = null, $body = null, $user_id = null, $created_at = null, $updated_at = null)
    {
        if ($id !== null) {
            $this->id = $id;
            $this->title = $title;
            $this->body = $body;
            $this->created_at = $created_at;
            $this->updated_at = $updated_at;
            $this->user_id = $user_id;
        }
    }

    public function getNotes()
    {
        $sql = "SELECT * FROM `posts` ORDER BY created_at DESC;";
        $stmt = Connection::getInstance()->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function getNoteObjects()
    {
        $sql = "SELECT * FROM `posts` ORDER BY created_at DESC;";
        $stmt = Connection::getInstance()->connect()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Note');
    }

    public function save($title, $note, $id)
    {
        $this->title = $title;
        $this->body = $note;
        $this->user_id = $id;
        $this->created_at = date('Y-m-d H:i:s');
        $this->updated_at = date('Y-m-d H:i:s');

        $query = "INSERT INTO posts (user_id, title, body, created_at, updated_at) VALUES ( :id, :title, :body, :created_at, :updated_at);";

        $stmt = Connection::getInstance()->connect()->prepare($query);

        $stmt->bindParam(':id', $this->user_id);
        $stmt->bindParam(':title', $this->title);
        $stmt->bindParam(':body', $this->body);
        $stmt->bindParam(':created_at', $this->created_at);
        $stmt->bindParam(':updated_at', $this->updated_at);

        return $stmt->execute();
    }

    public function getIdFromDb()
    {
        $sql = "SELECT id FROM `posts` WHERE title = :title AND body = :body;";
        $stmt = Connection::getInstance()->connect()->prepare($sql);
        $stmt->bindValue(':title', $this->title);
        $stmt->bindValue(':body', $this->body);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM `posts` WHERE id = :id;";
        $stmt = Connection::getInstance()->connect()->prepare($sql);
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }



    public function getNoteById($id)
    {
        $sql = "SELECT * FROM `posts` WHERE id = :id;";
        $stmt = Connection::getInstance()->connect()->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetchObject('Note');
    }

    public function update($title, $note, $id) {
        $query = "UPDATE `posts` SET `body` = :body, `title` = :title WHERE `id` = :id;;";
        $params = [
            ':title' => $title,
            ':body' => $note,
            ':id' => $id
        ];
        $stmt = Connection::getInstance()->connect()->prepare($query);
        return $stmt->execute($params);
    }

    //getters and setters
    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        if ($id === null) {
            echo /*html*/"<h4>Note: No id provided.</h4>";
        } else {
            $this->id = $id;
        }
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        if ($title === null) {
            echo /*html*/"<h4>Note: No title provided.</h4>";
        } else {
            $this->title = $title;
        }
    }
    public function getBody()
    {
        return $this->body;
    }
    public function setBody($body)
    {
        if ($body === null) {
            echo /*html*/"<h4>Note: No body provided.</h4>";
        } else {
            $this->body = $body;
        }
    }
    public function getUserId()
    {
        return $this->user_id;
    }
    public function setUserId($user_id)
    {
        if ($user_id === null) {
            echo /*html*/"<h4>Note: No user_id provided.</h4>";
        } else {
            $this->user_id = $user_id;
        }
    }
    public function getCreatedAt()
    {
        return $this->created_at;
    }
    public function setCreatedAt($created_at)
    {
        if ($created_at === null) {
            echo /*html*/"<h4>Note: No created_at provided.</h4>";
        } else {
            $this->created_at = $created_at;
        }
    }
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
    public function setUpdatedAt($updated_at)
    {
        if ($updated_at === null) {
            echo /*html*/"<h4>Note: No updated_at provided.</h4>";
        } else {
            $this->updated_at = $updated_at;
        }
    }
}