<?php


class HomeController
{

    public function index()
    {

        $data = [
        ];
        view('home', 'index', $data);
    }


}