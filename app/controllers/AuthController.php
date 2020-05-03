<?php


class AuthController
{

    public function login()
    {
//        var_dump($_SESSION);
        $data = [
        ];
        view('auth', 'login', $data);
    }

    public function auth()
    {
//        var_dump($_POST);
//        var_dump($_SESSION);


//        $_SESSION["username"] = "arneanka";
        $user = new User();
        $user->login($_POST["username"], $_POST["password"]);
//        var_dump($user);
        if ($user->username) {
            $_SESSION["username"] = $user->username;
        }
        $data = [
        ];
        header("Location: /");
//        var_dump($_SESSION);
    }

    public function logout()
    {
        unset($_SESSION["username"]);
        header("Location: /");
    }

}