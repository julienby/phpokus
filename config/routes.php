<?php

return [
    '/' => 'HomeController@index',
    '/home' => 'HomeController@index',
    '/page' => 'PageController@index',
    '/page/view' => 'PageController@view',
    '/about' => 'PageController@about',
    '/contact' => 'PageController@contact',
    '/users/create/{id}' => 'UserController@create',
    '/users' => 'UserController@index',
    '/user/{id}' => 'UserController@show',

    // Route avec un paramètre dynamique
    '/page/view/{id}' => 'PageController@view',
];

