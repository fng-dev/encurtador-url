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

// $router->get('/', function () use ($router) {
//     return $router->app->version();
// });

$router->group(['namespace' => 'Auth'], function($router) {
    $router->post('/auth/create/user', 'AuthController@create');
    $router->post('/auth/sign-in', 'AuthController@auth');
});

$router->group(['namespace' => 'Shortener', 'middleware' => ['short']], function($router) {
    $router->get('/', 'ShortenerController@index');
    $router->post('/shortener/create', 'ShortenerController@createShortUrl');
    $router->get('/{id}', 'ShortenerController@redirectUrl');
});

$router->group(['namespace' => 'Shortener'], function($router) {
    $router->get('/{id}', 'ShortenerController@redirectUrl');
});
