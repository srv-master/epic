<?php


class Post
{
    public $postId, $heading, $body, $userId;
    public $username, $bio, $img;

    public function __construct(
        string $heading = null,
        string $body = null,
        int $userId = null
    )
    {
        $heading ? $this->heading = $heading : false;
        $body ? $this->body = $body : false;
        $userId ? $this->userId = $userId : false;
    }

    public function find(int $id)
    {
        $id = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
//        $query = "select * from posts where postId=:id";
        $query = "
            select * 
            from posts 
                join users u on posts.userId = u.userId
            where postId=:id";
//        $stmt = $this->pdo->prepare($query);
        $stmt = Singleton::getInstance()->getPDO()->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            $this->postId = intval($result->postId);
            $this->heading = $result->heading;
            $this->body = $result->body;
            $this->userId = intval($result->userId);
            $this->username = $result->username;
            $this->bio = $result->bio;
            $this->img = $result->postImg;
        }
    }

}