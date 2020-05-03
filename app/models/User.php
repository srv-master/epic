<?php


class User
{
    public $userId, $username, $bio, $userImg, $password;


    public function __construct(
        int $userId = null,
        string $username = null,
        string $bio = null,
        string $userImg = null,
        string $password = null
    )
    {
        $userId ? $this->userId = $userId : false;
        $username ? $this->username = $username : false;
        $bio ? $this->bio = $bio : false;
        $userImg ? $this->userImg = $userImg : false;
        $password ? $this->password = $password : false;
    }

    public function login(string $username, string $password)
    {
        $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_var($password, FILTER_SANITIZE_SPECIAL_CHARS);
        $query = "
            select * 
            from users 
            where username=:username
            and password=:password";
//        $stmt = $this->pdo->prepare($query);
        $stmt = Singleton::getInstance()->getPDO()->prepare($query);
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch();

        if ($result) {
            $this->userId = intval($result->userId);
            $this->username = $result->username;
            $this->bio = $result->bio;
            $this->userImg = $result->userImg;
            $this->password = $result->password;
        }
    }


}