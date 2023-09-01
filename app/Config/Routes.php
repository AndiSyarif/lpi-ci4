<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'AuthController::index', ['filter' => 'guest']);
$routes->post('/login', 'AuthController::login');
$routes->post('/logout', 'AuthController::logout');

$routes->group('', ['filter' => 'auth'], function ($routes) {

    $routes->get('/', 'DashboardController::index');

    $routes->get('/dashboard', 'DashboardController::index');

    $routes->resource('user', ['controller' => 'UserController']);

    $routes->resource('employee', ['controller' => 'EmployeeController']);

    $routes->get('/setting/(:num)/edit', 'SettingController::edit/$1');

    $routes->put('/setting/(:num)', 'SettingController::update/$1');

    $routes->put('/setting/security/(:num)', 'SettingController::security/$1');
});
