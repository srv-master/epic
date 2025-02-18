<?php


class Post
{
    public $postId, $heading, $body, $userId, $postImg;
    public $username, $bio, $userImg;

    public function __construct(
        string $heading = null,
        string $body = null,
        int $userId = null,
        string $postImg = null
    )
    {
        $heading ? $this->heading = $heading : false;
        $body ? $this->body = $body : false;
        $userId ? $this->userId = $userId : false;
        $postImg ? $this->userId = $postImg : false;
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
            $this->postImg = $result->postImg;
        }
    }

    public function update(int $id)
    {
        $id = filter_var($id, FILTER_SANITIZE_SPECIAL_CHARS);
//        $input = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $input = [];

        foreach ($_POST as $dirtyKey => $dirtyValue) {
            $input[$dirtyKey] = $purifier->purify($dirtyValue);
        }
//        var_dump($input);
        $query = "
            update posts
            set heading=:heading, body=:body
            where postId=:id";
        $stmt = Singleton::getInstance()->getPDO()->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':heading', $input["heading"]);
        $stmt->bindValue(':body', $input["body"]);
        $stmt->execute();
    }

}