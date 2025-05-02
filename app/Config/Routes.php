<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/home/getModelsByBrand', 'Home::getModelsByBrand');
$routes->post('/home/getTypesByModel', 'Home::getTypesByModel');
