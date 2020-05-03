<?php
require "../app/bootstrap.php";
//var_dump($_SERVER);


$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    // home
    $r->addRoute('GET', '/', 'HomeController@index');

    // login
    $r->addRoute('GET', '/login', 'AuthController@login');
    $r->addRoute('POST', '/login', 'AuthController@auth');
    $r->addRoute('GET', '/logout', 'AuthController@logout');
    // posts
    $r->addRoute('GET', '/posts', 'PostsController@index');
    $r->addRoute('GET', '/posts/{id:\d+}[/]', 'PostsController@show');
    $r->addRoute('GET', '/posts/{id:\d+}/edit[/]', 'PostsController@edit');
    $r->addRoute('GET', '/posts/{id:\d+}/delete[/]', 'PostsController@delete');
    $r->addRoute('POST', '/posts/{id:\d+}[/]', 'PostsController@update');
    $r->addRoute('GET', '/posts/new[/]', 'PostsController@new');
    $r->addRoute('POST', '/posts', 'PostsController@store');

    // users
    $r->addRoute('GET', '/users/new[/]', 'UsersController@new');
    $r->addRoute('GET', '/users/{username}[/]', 'UsersController@show');
//    $r->addRoute('GET', '/users/{username}/edit[/]', 'UsersController@edit');
//    $r->addRoute('GET', '/users/{id:\d+}/delete[/]', 'UsersController@delete');
//    $r->addRoute('POST', '/users/{id:\d+}[/]', 'UsersController@update');

    $r->addRoute('POST', '/users', 'UsersController@store');


    // {id} must be a number (\d+)
//    $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
    // The /{title} suffix is optional
//    $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
});

// Fetch method and URI from somewhere
$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

// Strip query string (?foo=bar) and decode URI
if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        // ... 404 Not Found
        echo "404 hittades inte";
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        // ... 405 Method Not Allowed
        echo "Rutt hittad men fel protokoll";
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        $tmp = explode("@", $handler);
//        var_dump($tmp);
        $class = $tmp[0];
        $method = $tmp[1];
        $controller = new $class;
        $controller->$method($vars);
        break;
}