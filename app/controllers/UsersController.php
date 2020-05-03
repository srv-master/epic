<?php


class UsersController
{


    /**
     * Visa en User utifrån id i urlen
     * @param $vars array Tar in Indata från routing
     */
    public function show(array $vars)
    {
        $user = new User();
        $user->find($vars["username"]);
//        var_dump($post);
        $data = [
            "user" => $user
        ];
        view('users', 'show', $data);

    }

    /**
     * Visar vyn för att redigera en Post
     * @return boolean success
     */
    public function edit(array $vars)
    {
        auth();
        $user = new User();
        $user->find($vars["username"]);
//        var_dump($post);
        $data = [
            "user" => $user
        ];
        view('users', 'edit', $data);
    }

    public function delete(array $vars)
    {
        auth();

    }

    public function update(array $vars)
    {
        auth();
        $user = new User();
        $user->update($vars["id"]);
        header('Location: /users/' . $vars["id"]);
    }

    public function new(array $vars)
    {
        $data = [
        ];
        view('users', 'new', $data);
    }

    public function store(array $vars)
    {
        echo "<br>Sparar en ny med insert-fråga";
        var_dump($_POST);
        $user = new User();
        $user->store();
    }
}