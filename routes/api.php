<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* @var \Illuminate\Routing\Router $router */
$router->get('contacts', 'Api\ContactController@index');
$router->post('contacts/files', 'Api\ContactFileController@store');
$router->patch('contacts/files/{contactFile}/mappings', 'Api\ContactFileMappingsController@update');
