<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
//$routes->get('test-database', 'TestController::testDatabase');
//$routes->post('user/create', 'UserController::create');
$routes->get('register', 'Register::index');
$routes->post('register/save', 'Register::save');
$routes->get('login', 'Login::index');
$routes->post('login/authenticate', 'Login::authenticate');
$routes->get('logout', 'Login::logout');
$routes->get('user', 'Register::ind');
$routes->post('delete-account', 'Register::deleteAccount');
$routes->get('register/edit', 'Register::edit');
$routes->post('register/update', 'Register::update');
