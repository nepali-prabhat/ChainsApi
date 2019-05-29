<?php
    $router->group(['prefix'=>'chains'],function ()use($router) {
        $router->group(['middleware'=>'jwt'],function()use ($router){
            $router->post('make','ChainController@makeChain');
            $router->put('complete/{id}','ChainController@completeChain');
        });

        $router->get('user/{id}','ChainController@getUserChains');
        $router->get('user/{id}/completed','ChainController@getCompletedChain');

    });
