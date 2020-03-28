<?php


class Post
{
    public $postId, $heading, $body, $userId;
    public $table = 'posts';
    public $pdo;

    public function __construct(
        string $heading = null,
        string $body = null,
        int $userId = null
    )
    {
        $heading ? $this->heading = $heading : false;
        $body ? $this->body = $body : false;
        $userId ? $this->userId = $userId : false;

        $host = '192.168.250.74';
        $user = 'demo1234';
        $pass = 'demo1234';
        $dbName = 'demo1234';
        $dsn = "mysql:dbname=$dbName;host=$host;port=3306;charset=utf8";
        $this->pdo = new PDO($dsn, $user, $pass);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    public function find(int $id)
    {
        $id = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
        $query = "select * from posts where postId=:id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        $result = $stmt->fetch();

        if($result){
            $this->postId = intval($result->postId);
            $this->heading = $result->heading;
            $this->body = $result->body;
            $this->userId = intval($result->userId);
        }
    }

}