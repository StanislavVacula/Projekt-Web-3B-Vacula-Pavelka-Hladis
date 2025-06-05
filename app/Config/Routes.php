<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Domovská stránka
$routes->get('/', 'Home::index');

// AJAX požadavky pro získání modelů a typů
$routes->post('/home/getModelsByBrand', 'Home::getModelsByBrand');
$routes->post('/home/getTypesByModel', 'Home::getTypesByModel');

// Routy pro přihlášení a odhlášení
$routes->get('login', 'Login::index'); // Zobrazení přihlašovací stránky
$routes->post('login', 'Login::auth'); // Zpracování přihlášení
$routes->get('logout', 'Login::logout'); // Odhlášení uživatele

// Skupina rout pro administraci s filtrem 'auth'
$routes->group('administrace', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', 'Dashboard::index'); // Administrativní dashboard
    $routes->get('odhlaseni', 'Dashboard::logout'); // Odhlášení z administrace
    $routes->get('profil/edit', 'Profile::edit'); // Úprava profilu
});