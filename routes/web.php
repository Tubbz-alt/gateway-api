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

$router->group(['prefix' => 'api/v1'], function () use ($router) {

    $router->get('/', function () use ($router) {
        return 'Gateway Api v1: ' . $router->app->version();
    });

    $router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('/ntlm-example', 'ExampleController@ntlmExample');
        $router->post('/referral-order-example', 'ExampleController@referralOrderValidationExample');
        $router->post('/tests-locations-example', 'ExampleController@testsSetValidationExample');
    });

});
