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

    /**
     * Visa en Post utifrån id i urlen
     * @param $vars array Tar in Indata från routing
     */
    public function show(array $vars)
    {
        $post = new Post();
        $post->find($vars["id"]);

        $data = [
            "post" => $post
        ];
        view('posts', 'show', $data);


    }

    /**
     * Visar vyn för att redigera en Post
     * @return boolean success
     */
    public function edit()
    {
        echo "<br>Formulär för att redigera";
//        var_dump($vars);
//        TODO hämta från db med modell
//        TODO visa på skärm med vy
        return true;
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