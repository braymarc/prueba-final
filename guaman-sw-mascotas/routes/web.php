<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
$router->post('login', 'UsuarioController@login');
$router->group(['middleware'=>'auth'],function ()use ($router){
    $router->get('salir', 'UsuarioController@salir');
    $router->group(['prefix'=>'cliente'],function ($router){
        $router->post('/', 'ClienteController@create');
    });
    $router->group(['prefix'=>'mascota'],function ($router){
        $router->post('/', 'MascotaController@create');
        $router->get('/all', 'MascotaController@getAll');
    });
    $router->group(['prefix'=>'turno'],function ($router){
        $router->post('/', 'TurnoController@create');
    });
});
