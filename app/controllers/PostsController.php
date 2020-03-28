<?php


class PostsController
{

    public function index()
    {

//        ---- model ----
//        TODO hämta från db med modell
        $users = [
            ['username'=>'sunkan', 'age'=>41],
            ['username'=>'mallis', 'age'=>34]
        ];

//        ---- view ----
        $data = [
            "users"=>$users
        ];
        view('posts','index',$data);
    }

    public function show($vars)
    {
        echo __METHOD__ . "<br>";
        $id = $vars["id"];
//        $post = new Post('Fiskbil','Lorem tuna',2);
        $post = new Post();
        $post->find($id);
        var_dump($post);

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