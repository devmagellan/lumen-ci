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

$router->group(['prefix' => 'auth'], function () use ($router) {

    $router->post('login', 'Auth\LoginController@login');
    $router->post('register', 'Auth\RegisterController@register');

    $router->group(['prefix' => 'password', 'as' => 'password'], function () use ($router) {

        $router->post('/email', ['uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail', 'as' => 'email']);

        $router->post('/reset', ['uses' => 'Auth\ResetPasswordController@reset', 'as' => 'update']);

        $router->get('/reset/{token}', ['uses' => 'Auth\ResetPasswordController@showResetForm', 'as' => 'reset']);

    });
});

$router->group(['middleware' => 'auth:web'], function () use ($router) {

    $router->group(['prefix' => 'auth'], function () use ($router) {
        $router->post('logout', 'Auth\LoginController@logout');
        $router->post('refresh', 'Auth\LoginController@refresh');
        $router->get('me', 'UserController@show');
        $router->put('me', 'UserController@update');
    });

    $router->group(['prefix' => 'firm'], function () use ($router) {
        $router->get('/', 'FirmController@index');
        $router->get('/{firmId}', 'FirmController@show');
        $router->post('/', 'FirmController@store');
        $router->put('/{firmId}', 'FirmController@update');
        $router->delete('/{firmId}', 'FirmController@destroy');
    });

});
