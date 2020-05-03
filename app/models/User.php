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
            where username=:username";
        $stmt = Singleton::getInstance()->getPDO()->prepare($query);
        $stmt->bindValue(':username', $username);
//        $stmt->bindValue(':password', $password);
        $stmt->execute();
        $result = $stmt->fetch();
        var_dump($_POST);
        var_dump($result);
        if (password_verify($password, $result->password)) {
            $this->userId = intval($result->userId);
            $this->username = $result->username;
            $this->bio = $result->bio;
            $this->userImg = $result->userImg;
            $this->password = $result->password;
        }
    }

    public function find(string $username)
    {
        $username = filter_var($username, FILTER_SANITIZE_SPECIAL_CHARS);
        $query = "
            select * 
            from users 
            where username=:username
            limit 1";
        $stmt = Singleton::getInstance()->getPDO()->prepare($query);
        $stmt->bindValue(':username', $username);
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

    public function store()
    {
        $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_SPECIAL_CHARS);
        $bio = filter_input(INPUT_POST, "bio", FILTER_SANITIZE_SPECIAL_CHARS);

        $config = HTMLPurifier_Config::createDefault();
        $purifier = new HTMLPurifier($config);
        $input = [];

        foreach ($_POST as $dirtyKey => $dirtyValue) {
            $input[$dirtyKey] = $purifier->purify($dirtyValue);
        }
        $input["password"] = password_hash($input["password"], PASSWORD_DEFAULT);
        $query = "
            insert into users(username, password, bio)
            values (:username, :password, :bio)";
        $stmt = Singleton::getInstance()->getPDO()->prepare($query);
        $stmt->bindValue(':username', $input["username"]);
        $stmt->bindValue(':password', $input["password"]);
        $stmt->bindValue(':bio', $input["bio"]);
        $stmt->execute();
//
//        $result = $stmt->fetch();
//        if ($result) {
//            $this->userId = intval($result->userId);
//            $this->username = $result->username;
//            $this->bio = $result->bio;
//            $this->userImg = $result->userImg;
//            $this->password = $result->password;
//        }
    }

}