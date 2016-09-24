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

$app->group(['prefix' => 'api', 'namespace' => 'App\Http\Controllers\Api'], function () use ($app) {
    $app->post('login', 'AuthController@login');
    $app->post('register', 'AuthController@register');

    $app->get('users', 'UsersController@index');
    $app->get('user/{user}', 'UsersController@show');
    $app->post('user', 'UsersController@store');
    $app->patch('user/{user}', 'UsersController@update');
    $app->delete('user/{user}', 'UsersController@destroy');
});

$app->group(['namespace' => 'App\Http\Controllers\Auth'], function () use ($app) {
    $app->get('login', 'AuthController@showLogin');
    $app->post('login', 'AuthController@postLogin');
    $app->get('register', 'AuthController@showRegister');
    $app->post('register', 'AuthController@postRegister');
    $app->get('logout', 'AuthController@logout');
});

$app->group(['prefix' => 'admin', 'namespace' => 'App\Http\Controllers\Admin'], function () use ($app) {
    $app->get('/', 'HomeController@index');
    $app->get('profile', 'ProfileController@index');
    $app->patch('profile/info', 'ProfileController@info');
    $app->patch('profile/password', 'ProfileController@password');

    $app->get('users', 'UsersController@index');
    $app->get('user/create', 'UsersController@create');
    $app->post('user', 'UsersController@store');
    $app->get('user/{user}', 'UsersController@show');
    $app->get('user/{user}/edit', 'UsersController@edit');
    $app->patch('user/{user}', 'UsersController@update');
    $app->delete('user/{user}', 'UsersController@destroy');

    $app->get('categories', 'CategoriesController@index');
    $app->get('category/create', 'CategoriesController@create');
    $app->post('category', 'CategoriesController@store');
    $app->get('category/{category}', 'CategoriesController@show');
    $app->get('category/{category}/edit', 'CategoriesController@edit');
    $app->patch('category/{category}', 'CategoriesController@update');
    $app->delete('category/{category}', 'CategoriesController@destroy');

    $app->get('tags', 'TagsController@index');
    $app->get('tag/create', 'TagsController@create');
    $app->post('tag', 'TagsController@store');
    $app->get('tag/{tag}', 'TagsController@show');
    $app->get('tag/{tag}/edit', 'TagsController@edit');
    $app->patch('tag/{tag}', 'TagsController@update');
    $app->delete('tag/{tag}', 'TagsController@destroy');

    $app->get('posts', 'PostsController@index');
    $app->get('post/create', 'PostsController@create');
    $app->post('post', 'PostsController@store');
    $app->get('post/{post}', 'PostsController@show');
    $app->get('post/{post}/edit', 'PostsController@edit');
    $app->patch('post/{post}', 'PostsController@update');
    $app->delete('post/{post}', 'PostsController@destroy');
});

$app->group(['namespace' => 'App\Http\Controllers\Theme'], function () use ($app) {
    $app->get('/', 'HomeController@index');
    $app->get('profile', 'ProfileController@index');
});
