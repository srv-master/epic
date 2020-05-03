<?php


class HomeController
{

    public function index()
    {
        // inloggad
        if (isset($_SESSION["username"])) {
            $data = [
            ];
            view('home', 'index', $data);
        } else {
            header("Location: /login");
        }
    }


}