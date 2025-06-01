<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/home/getModelsByBrand', 'Home::getModelsByBrand');
$routes->post('/home/getTypesByModel', 'Home::getTypesByModel');
$routes->get('login', 'Home::login');
$routes->get('login', 'Login::index');
$routes->post('login', 'Login::auth');
$routes->get('logout', 'Login::logout');
