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
        var_dump($_POST);
        var_dump($_SESSION);

        // login OK
        // TODO riktigt login

        $_SESSION["username"] = "arneanka";

        $data = [
        ];
        header("Location: /");
    }

    public function logout()
    {
        unset($_SESSION["username"]);
        header("Location: /");
    }

}