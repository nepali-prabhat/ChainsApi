<?php
$router->group(['prefix' => 'users'], function () use ($router) {
    $router->post('login', "UserController@login");
    $router->post('signup', "UserController@signup");
    $router->get('details/{id}',['middleware'=>'jwt','uses'=>'UserController@userDetails']);
});
