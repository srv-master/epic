<?php


class PostController
{

    public function index()
    {

//        TODO hämta från db med modell

        require VIEWS . DIRECTORY_SEPARATOR . 'posts' . DIRECTORY_SEPARATOR . 'index.php';
    }

    public function show($vars)
    {
        echo "<br>Visa 1 post med detaljer";
        var_dump($vars);
//        TODO hämta från db med modell
//        TODO visa på skärm med vy
    }

    public function edit()
    {
        echo "<br>Formulär för att redigera";
//        var_dump($vars);
//        TODO hämta från db med modell
//        TODO visa på skärm med vy
    }

    public function delete()
    {
        echo "<br>Döda post med delete-fråga";
//        var_dump($vars);
//        TODO hämta från db med modell
//        TODO visa på skärm med vy
    }

    public function update()
    {
        echo "<br>Spara ändringar med update-fråga mot db";
//        var_dump($vars);
//        TODO hämta från db med modell
//        TODO visa på skärm med vy
    }

    public function add()
    {
        echo "<br>Formulär som man fyller i för att göra en ny";
//        var_dump($vars);
//        TODO hämta från db med modell
//        TODO visa på skärm med vy
    }

    public function store()
    {
        echo "<br>Sparar en ny med insert-fråga";
//        var_dump($vars);
//        TODO hämta från db med modell
//        TODO visa på skärm med vy
    }
}