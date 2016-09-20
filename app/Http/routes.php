<?php

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

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->post('login', 'Auth\AuthController@login');
$app->post('register', 'Auth\AuthController@register');

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers\Api'], function () use ($app) {
    $app->get('users', 'UsersController@index');
    $app->get('user/{user}', 'UsersController@show');
    $app->post('user', 'UsersController@store');
    $app->patch('user/{user}', 'UsersController@update');
    $app->delete('user/{user}', 'UsersController@destroy');
});
