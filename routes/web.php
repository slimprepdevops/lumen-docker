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

$router->group(['prefix' => '/api/v1'], function () use ($router) {
    $router->get('/', function () use ($router) {
        return response()->json([
            'status' => 'success',
            'message' => 'API is running',
            'version' => '1.0.0'
        ], 200);
    });

    // Auth routes
    $router->group(['prefix' => '/auth', 'namespace' => 'Auth'], function () use ($router) {
        $router->post('/register', 'AuthController@register');
        $router->post('/login', 'AuthController@login');
    });

    $router->group(['prefix' => '/nodes', 'middleware' => 'auth'], function () use ($router) {
        $router->get('/', 'NodeController@index');
        $router->post('/', 'NodeController@store');
        $router->get('/{id}', 'NodeController@show');
        $router->patch('/{id}', 'NodeController@update');
        $router->delete('/{id}', 'NodeController@destroy');
    });

});
